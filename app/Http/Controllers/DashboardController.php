<?php namespace App\Http\Controllers;







use App\Appel;

use App\Bill;

use App\Extra\GoogleAnalyticsAPI;

use App\Extra\ImapAPI;

use App\Extra\WannaSpeakAPI;

use App\Pays;

use App\User;

use Validator;

use Nathanmac\Utilities\Parser\Parser;

use Request;

use Storage;

use Auth;

use Session;

use File;

use \Illuminate\Http\Response;

use DateTime;

use DateInterval;



class DashboardController extends Controller {



    public function __construct(){

        $this->middleware('auth', ['except' => ['login', 'logout']]);

    }



    function index(){



        if(Auth::user()->type == 0){

            $user = Auth::user();

        }elseif(Auth::user()->type == 1){

            $user = User::find(session()->get('user', 0));

        }else{

            if(!session()->get('visits', 0)){

                $visits = 0;

                $date = DateTime::createFromFormat("Y-m-d", date('Y-m-d', strtotime('-30 days')));

                for($i = 0; $i < 30; $i++){

                    $dates[$i] = array(

                        'label' => $date->format("Y-m-d"),

                        'value' => mt_rand(1, 20)

                    );

                    $visits += $dates[$i]['value'];

                    $date->add(new DateInterval("P1D"));

                }

                session()->put('visits', $visits);

                session()->put('visitsDate', $dates);

            }



            if(!session()->get('calls', 0)){

                $calls = array();

                $hours = array(

                    0 => "07:58:12",

                    1 => "12:14:25",

                    2 => "10:56:32",

                    3 => "11:04:24",

                    4 => "09:31:52",

                    5 => "17:47:15",

                    6 => "19:01:54",

                    7 => "16:33:42",

                    8 => "10:04:08",

                    9 => "14:08:41",



                );

                $sources = array(

                    0 => "0245851236",

                    1 => "0240332846",

                    2 => "0299147585",

                    3 => "0288451763",

                    4 => "0222478596",

                    5 => "0233457896",

                    6 => "0299258564",

                    7 => "0299851245",

                    8 => "0240128574",

                    9 => "0230147899",



                );



                $terminate = array(

                    0 => "ANSWER",

                    1 => 'NONE'

                );

                $date = DateTime::createFromFormat("Y-m-d", date('Y-m-d', strtotime('-30 days')));

                for($i = 0; $i < 10; $i ++){

                    $duration = mt_rand(0, 240);

                    $calls[] = array(

                        'starttime' => $date->format("Y-m-d") . " " . $hours[$i],

                        'duration' => $duration,

                        'source' => $sources[$i],

                        'pertinant' => 1,

                        'terminatecause' => $duration > 20 ? "ANSWER" : $terminate[mt_rand(0, 1)]

                    );

                    $day = mt_rand(1, 3);

                    $date->add(new DateInterval("P{$day}D"));

                }

                session()->put('calls', $calls);

            }



            if(!session()->get('messages', 0)){

                session()->put('messages', 0);

            }



            setlocale(LC_ALL, 'fr_FR');

            return view('dashboard.index')->with(array(

                'visits' => session()->get('visits', 0),

                'calls' => session()->get('calls', array()),

                'messages' => session()->get('messages', 0)

            ));

        }





        $client_id = '766771941565-i8us8l9u82du4604d57cqiesqumsf04t.apps.googleusercontent.com';

        $client_mail = '766771941565-i8us8l9u82du4604d57cqiesqumsf04t@developer.gserviceaccount.com';

        $visits = 0;

        $calls = array();

        $messages = 0;

		$nbTicket = 0;




        $ga = new GoogleAnalyticsAPI('service');

        $ga->auth->setClientId($client_id); // From the APIs console

        $ga->auth->setEmail($client_mail); // From the APIs console

        $ga->auth->setPrivateKey(config_path() . '/visiorank.p12');



        try {
            $auth = $ga->auth->getAccessToken();

        }catch (Exception $e){

            debug($e->getMessage());

        }

        // Try to get the AccessToken

        if ($auth['http_code'] == 200) {

            $accessToken = $auth['access_token'];

            $tokenExpires = $auth['expires_in'];

            $tokenCreated = time();

        } else {

            die("Sorry, something wend wrong retrieving the oAuth tokens : " . $auth['http_code']);

        }



        // Set the accessToken and Account-Id

        $ga->setAccessToken($accessToken);

        if($user) {

            // Load profiles

            $profilId = "ga:" . $user->analytics;





            if ($profilId != "ga:") {

                $ga->setAccountId($profilId);



                // Set the default params. For example the start/end dates and max-results

                $defaults = array(

                    'start-date' => date('Y-m-d', strtotime('-30 days')),

                    'end-date' => date('Y-m-d'),

                );

                $ga->setDefaultQueryParams($defaults);



                $tmp = $ga->getAudienceStatistics();

				if(isset($tmp['totalsForAllResults'])) {

                    $totalsForAllResults = $tmp['totalsForAllResults'];



                    $visits = $totalsForAllResults['ga:visits'];

                }



            }

            $wanna = new WannaSpeakAPI("0461851371", "6194134591");

            $tmp = $wanna->getListeAppels();

            foreach ($tmp as $call) {

                if ($call['inbound'] == $user->telephone) {

                    $calls[] = 1;

                }

            }

            if($user->email != "" && $user->imap != ""){

                $messages = ImapAPI::getUnseenMessages("{SSL0.OVH.NET:143/imap}", $user->email, $user->imap);

            }


			// Demande dans dashboard
            $nbTicket = ServiceDeskController::countTicketByUser ($user->id);
        }







        setlocale(LC_ALL, 'fr_FR');



        return view('dashboard.index')->with(array(

            'visits' => $visits,

            'calls' => $calls,

            'messages' => $messages
,
            'demande' => $nbTicket
        ));

    }



    function stats(){



        if(Auth::user()->type == 0){

            $user = Auth::user();

        }elseif(Auth::user()->type == 1){

            $user = User::find(session()->get('user', 0));

        }else{



            $cities = array();

            $noGeo = session()->get('visits', 0);

            $aube = 1;

            $matin = 4;

            $midi = 1;

            $apresmidi = 3;

            $soir = 1;



            return view('dashboard.stats')->with(array(

                'visits' => session()->get('visitsDate', array()),

                'cities' => $cities,

                'noGeo' => $noGeo,

                'aube' => $aube,

                'matin' => $matin,

                'midi' => $midi,

                'apresmidi' => $apresmidi,

                'soir' => $soir,

                'user' => 1

            ));

        }



        $client_id = '766771941565-i8us8l9u82du4604d57cqiesqumsf04t.apps.googleusercontent.com';

        $client_mail = '766771941565-i8us8l9u82du4604d57cqiesqumsf04t@developer.gserviceaccount.com';



        $calls = array();

        $dates = array();

        $cities = array();

        $noGeo = 0;

        $aube = 0;

        $matin = 0;

        $midi = 0;

        $apresmidi = 0;

        $soir = 0;







        $ga = new GoogleAnalyticsAPI('service');

        $ga->auth->setClientId($client_id); // From the APIs console

        $ga->auth->setEmail($client_mail); // From the APIs console

        $ga->auth->setPrivateKey(config_path() . '/visiorank.p12');



        try {

            $auth = $ga->auth->getAccessToken();

        }catch (Exception $e){

            debug($e->getMessage());

        }

        // Try to get the AccessToken

        if ($auth['http_code'] == 200) {

            $accessToken = $auth['access_token'];

            $tokenExpires = $auth['expires_in'];

            $tokenCreated = time();

        } else {

            die("Sorry, something wend wrong retrieving the oAuth tokens : " . $auth['http_code']);

        }



        // Set the accessToken and Account-Id

        $ga->setAccessToken($accessToken);



        if($user) {

            // Load profiles

            $profilId = "ga:" . $user->analytics;



            if ($profilId != "ga:") {

                $ga->setAccountId($profilId);



                // Set the default params. For example the start/end dates and max-results

                $defaults = array(

                    'start-date' => date('Y-m-d', strtotime('-30 days')),

                    'end-date' => date('Y-m-d'),

                );

                $ga->setDefaultQueryParams($defaults);





                $buff = $ga->getVisitsByDate();

                if(isset($buff['rows'])) {

                    $tmpStat = $buff['rows'];

                    $dates = array();

                    foreach ($tmpStat as $item) {

                        $dates[] = array(

                            'label' => substr($item[0], 0, 4) . "-" . substr($item[0], 4, 2) . "-" . substr($item[0], 6, 2),

                            'value' => $item[1]

                        );

                    }

                }



                $buff = $ga->getVisitsByCities();

                if(isset($buff['rows'])) {

                    $tmpStat = $buff['rows'];

                    $cities = array();

                    $noGeo = 0;

                    foreach ($tmpStat as $item) {

                        if ($item[0] == "(not set)") {

                            $noGeo += $item[2];

                        } else {

                            $cities[] = array(

                                'ville' => $item[0],

                                'latlng' => $this->_getPosition($item[1], $item[0]),

                                'value' => $item[2]

                            );

                        }



                    }

                    sort($cities);

                }



            }



            $aube = 0;

            $matin = 0;

            $midi = 0;

            $apresmidi = 0;

            $soir = 0;



            $wanna = new WannaSpeakAPI("0461851371", "6194134591");

            $tmp = $wanna->getListeAppels();

            foreach ($tmp as $call) {

                if ($call['inbound'] == $user->telephone) {

                    $calls[] = $call;

                }

            }



            foreach ($calls as $key => $call) {

                $heure = getHeure($call['starttime']);

                switch ($heure) {

                    case $heure < 8 :

                        $aube++;

                        break;

                    case $heure > 8 && $heure < 12 :

                        $matin++;

                        break;

                    case $heure > 12 && $heure < 14 :

                        $midi++;

                        break;

                    case $heure > 14 && $heure < 18 :

                        $apresmidi++;

                        break;

                    case $heure > 18 :

                        $soir++;

                        break;

                }

            }

        }





        return view('dashboard.stats')->with(array(

            'visits' => $dates,

            'cities' => $cities,

            'noGeo' => $noGeo,

            'aube' => $aube,

            'matin' => $matin,

            'midi' => $midi,

            'apresmidi' => $apresmidi,

            'soir' => $soir,

            'user' => $user

        ));

    }



    function calls(){

        if(Auth::user()->type == 0){

            $user = Auth::user();

        }elseif(Auth::user()->type == 1){

            $user = User::find(session()->get('user', 0));

        }else{

            return view('dashboard.calls')->with(array(

                'calls' => session()->get('calls', array()),

                'user' => Auth::user()

            ));

        }

        $calls = array();



        if($user) {

            $wanna = new WannaSpeakAPI("0461851371", "6194134591");

            $tmp = $wanna->getListeAppels();

            foreach ($tmp as $call) {

                if ($call['inbound'] == $user->telephone) {

                    $calls[] = $call;

                }

            }

            foreach ($calls as $key => $call) {

                $id = md5($call['starttime'] . $call['inbound']);

                $appel = Appel::find($id);

                if ($appel == null) {

                    $appel = new Appel;

                    $appel->id = $id;

                    $appel->pertinant = 1;



                    $appel->save();

                }

                $calls[$key]['pertinant'] = $appel->pertinant;

                $calls[$key]['id'] = $id;

            }

            array_multisort($calls, SORT_DESC);

        }

        return view('dashboard.calls')->with(array(

            'calls' => $calls,

            'user' => $user

        ));

    }



    function update_call(){

        $id = Request::get('id');

        $state = Request::get('state');

        $appel = Appel::find($id);

        if($appel){

            $appel->pertinant = $state;

            $appel->save();

        }

    }



    function messages(){

        if(Auth::user()->type == 0){

            $user = Auth::user();

        }elseif(Auth::user()->type == 1){

            $user = User::find(session()->get('user', 0));

        }else{

            $messages = array();

            return view('dashboard.messages')->with(array(

                'messages' => $messages,

                'user' => Auth::user()

            ));

        }

        $messages = array();

        if($user) {

            if($user->email != "" && $user->imap != ""){

                $messages = ImapAPI::getMessages("{SSL0.OVH.NET:143/imap}", $user->email, $user->imap);

            }



        }



        return view('dashboard.messages')->with(array(

            'messages' => $messages,

            'user' => $user

        ));

    }



    function read_message($id){

        if(Auth::user()->type == 0){

            $user = Auth::user();

        }else{

            $user = User::find(session()->get('user', 0));

        }



        if($user) {

            $message = ImapAPI::getMessage("{SSL0.OVH.NET:143/imap}", $user->email, $user->imap, $id);



            return view('dashboard.view_message')->with(array(

                'message' => $message,

                'user' => $user

            ));

        }else{

            return new Response();

        }



    }



    function get_attachment($id, $part, $encoding){

        if(Auth::user()->type == 0){

            $user = Auth::user();

        }else{

            $user = User::find(session()->get('user', 0));

        }



        if($user) {

            $pj = ImapAPI::downloadAttachment("{SSL0.OVH.NET:143/imap}", $user->email, $user->imap, $id, $part, $encoding);



            return (new Response($pj['message'], 200))

                ->header('Content-Description', "File Transfer")

                ->header('Content-Type', "application/octet-stream")

                ->header('Content-Disposition', "attachment; filename=" . $pj['filename'])

                ->header('Content-Transfer-Encoding', "binary")

                ->header('Expires', "0")

                ->header('Cache-Control', "must-revalidate")

                ->header('Pragma', "public");



        }else{

            return new Response();

        }



    }



    function bills(){

        if(Auth::user()->type == 0){

            $user = Auth::user();

        }else{

            $user = User::find(session()->get('user', 0));

        }



        return view('dashboard.bills')->with(array(

            'user' => $user

        ));

    }



    function add_bill(){

        $users = User::all()->lists('nom', 'id');

        return view('dashboard.add_bill')->with(array(

            'users' => $users

        ));

    }



    function save_bill(){



        if (Request::hasFile('facture')) {

            $user = Request::get('user');

            $file = Request::file('facture');



            Storage::put("bills/$user/" . $file->getClientOriginalName(),  File::get($file));

            $entry = new Bill();

            $entry->mime = $file->getClientMimeType();

            $entry->filename = $file->getClientOriginalName();

            $entry->user_id = $user;



            $entry->save();



        }

        return redirect()->action('DashboardController@bills');

    }



    function get_bill($filename){

        $entry = Bill::where('filename', '=', $filename)->firstOrFail();

        $file = Storage::get("bills/" . $entry->user_id . "/" . $entry->filename);



        return (new Response($file, 200))

            ->header('Content-Type', $entry->mime);



    }



    function users(){

        $users = User::where('type', '!=', 1)->get();

        return view('dashboard.users')->with(array(

            'users' => $users

        ));

    }



    function edit_user($id = null){

        $user = User::find($id);

        $profiles = array('' => 'Choisir le site à analyser');



        $client_id = '766771941565-i8us8l9u82du4604d57cqiesqumsf04t.apps.googleusercontent.com';

        $client_mail = '766771941565-i8us8l9u82du4604d57cqiesqumsf04t@developer.gserviceaccount.com';



        $ga = new GoogleAnalyticsAPI('service');

        $ga->auth->setClientId($client_id); // From the APIs console

        $ga->auth->setEmail($client_mail); // From the APIs console

        $ga->auth->setPrivateKey(config_path() . '/visiorank.p12');



        try {

            $auth = $ga->auth->getAccessToken();

        }catch (Exception $e){

            debug($e->getMessage());

        }

        // Try to get the AccessToken

        if ($auth['http_code'] == 200) {

            $accessToken = $auth['access_token'];

            $tokenExpires = $auth['expires_in'];

            $tokenCreated = time();

        } else {

            die("Sorry, something wend wrong retrieving the oAuth tokens : " . $auth['http_code']);

        }



        // Set the accessToken and Account-Id

        $ga->setAccessToken($accessToken);

        $results = $ga->getProfiles();

        if(isset($results['items'])){

            foreach($results['items'] as $profile){

                $profiles[$profile['id']] = $profile['websiteUrl'];

            }

        }



        return view('dashboard.edit_user')->with(array(

            'user' => $user,

            'profiles' => $profiles

        ));

    }



    function save_user(){

        $inputs = Request::all();

        $rules = array(

            'email' => 'required'

        );

        $validation = Validator::make($inputs, $rules);

        if ($validation->fails()) {

            return redirect()->back()->withInput()->withErrors($validation)->with('alert_error', 'Veuillez corriger les erreurs');

        }

        if(Request::input('id')){

            $user = User::find(Request::get('id'));

            if (!$user) {

                return redirect()->action('DashboardController@edit_user')->withInput()->with('alert_error', "Une erreur est survenue lors de l'enregistrement");

            }

            $password = false;

        }else{

            $user = new User;

            $password = true;

        }



        $user->nom = Request::get('nom');

        $user->prenom = Request::get('prenom');

        $user->societe = Request::get('societe');

        $user->telephone = Request::get('telephone');

        $user->analytics = trim(Request::get('analytics'));

        $user->email = trim(Request::get('email'));

        $user->imap = trim(Request::get('imap'));

        $user->type = 0;





        if($password || Request::get('password') != ""){

            $user->password = bcrypt(Request::get('password'));

        }



        $user->save();

        return redirect()->action('DashboardController@users');

    }



    public function update_user() {

        session()->put('user', Request::get('id'));

        return "OK";



    }



	public function delete_user ($id){
        $user = User::find($id);
        if (!$user)
            return redirect()->action('DashboardController@users')->withInput()->with('alert_error', "Une erreur est survenue lors de la suppression");
        $user->delete();
        return redirect()->action('DashboardController@users');
    }

    function login(){

        if(Request::input('login')) {

            $email = Request::input('email');

            $password = Request::input('password');

            if (Auth::attempt(array('email' => $email, 'password' => $password))) {

                session()->put('user', 0);

                return redirect()->intended('/');

            } else {

                dd('Erreur');

            }



        }

        return view('dashboard.login');

    }



    public function logout() {

        if(Auth::user()->type == 99){

            Session::flush();

        }

        Auth::logout();

        return redirect()->action("DashboardController@login");



    }











    private function _getPosition($nom, $ville){

        $pays = Pays::where('nom', '=', $nom)->first();

        if($pays){

            $code = $pays->code;

            try {

                $stats = file_get_contents("https://maps.googleapis.com/maps/api/geocode/xml?address=". str_replace(" ", "+", $ville) . ",+$code&key=AIzaSyDwxxyQso1fY8Gx2kJ-kbcsXSLUmT1HmkY");

            }catch(\Exception $e){

                return null;

            }

            $parser = new Parser();

            $parsed = $parser->xml($stats);

            $latLng = array();

            if(isset($parsed['result']['geometry']['location'])){

                $latLng = array(

                    "lat" => $parsed['result']['geometry']['location']['lat'],

                    "lng" => $parsed['result']['geometry']['location']['lng']

                );

            }



            return $latLng;

        }else{

            return null;

        }

    }

}