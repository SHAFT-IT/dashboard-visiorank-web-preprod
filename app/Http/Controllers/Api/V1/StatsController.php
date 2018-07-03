<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use App\Extra\GoogleAnalyticsAPI;
use App\Extra\ImapAPI;
use App\Extra\WannaSpeakAPI;
use App\Http\Controllers\ServiceDeskController;
use Auth;
use App\Pays;
use Nathanmac\Utilities\Parser\Parser;
ini_set('max_execution_time', -1);

class StatsController extends Controller {
    use Helpers;

    /**
     * params: token
     * return: Json Array
     * url {BASE_URL}/api/ws_get_stats/{token}
     */
    public function ws_get_stats($token) { 
        $user = session()->get("user_mobile");
        if (is_null($user)) {
            return $this->response->array ("1002"); // No session
        }

        $client_id = \Config::get('constants.ws.ga_client_id');
        $client_mail = \Config::get('constants.ws.ga_client_mail');
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
        } catch (Exception $e){
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
        if ($user) {
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
        return$this->response->array(array(
            'visits' => $dates,
            'cities' => $cities,
            'noGeo' => $noGeo,
            'aube' => $aube,
            'matin' => $matin,
            'midi' => $midi,
            'apresmidi' => $apresmidi,
            'soir' => $soir,
        ));
    }

    private function _getPosition($nom, $ville) {
        $pays = Pays::where('nom', '=', $nom)->first();
        if($pays) {
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
        }else {
            return null;
        }
    }
}

