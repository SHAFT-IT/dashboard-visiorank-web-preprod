<?php
/**
 * Created by PhpStorm.
 * User: MShAft
 * Date: 09/07/2018
 * Time: 15:06
 */

namespace App\Http\Controllers\Api\V1;

use App\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Auth;
use App\Extra\GoogleAnalyticsAPI;
use Dingo\Api\Contract\Http\Request;


class UsersController extends Controller
{
    use Helpers;
    public function ws_get_users($token) {
        $user = User::where('mobile_token', $token)->first();
        if (is_null($user)) {
            return $this->response->array ("1002");
        }

        if ($user->type == 1) { // Administrator
            return $this->response->array(User::where('type', '=', 0)->get());
        } else { // Not granted
            return $this->response->array("1005");
        }
    }

    public function ws_get_sites($token) {
        $user = User::where('mobile_token', $token)->first();
        if (is_null($user)) {
            return $this->response->array ("1002");
        }
        $client_id = \Config::get('constants.ws.ga_client_id');
        $client_mail = \Config::get('constants.ws.ga_client_mail');
        $ga = new GoogleAnalyticsAPI('service');
        $ga->auth->setClientId($client_id); // From the APIs console
        $ga->auth->setEmail($client_mail); // From the APIs console
        $ga->auth->setPrivateKey(config_path() . '/visiorank.p12');
        try {
            $auth = $ga->auth->getAccessToken();
        }catch (Exception $e){
            return $this->response->array ($e->getMessage());
        }
        // Try to get the AccessToken
        if ($auth['http_code'] == 200) {
            $accessToken = $auth['access_token'];
        } else {
            return $this->response->array ("Sorry, something wend wrong retrieving the oAuth tokens : " . $auth['http_code']);
        }
        // Set the accessToken and Account-Id
        $ga->setAccessToken($accessToken);
        $results = $ga->getProfiles();
        $sites = array();
        if(isset($results['items'])){
            foreach($results['items'] as $profile){
                $site['id'] =  $profile['id'];
                $site['websiteUrl'] = $profile['websiteUrl'];
                array_push($sites, $site);
            }
        }
        return $this->response->array($sites);
    }

    public function ws_save_user($token, Request $request)
    {
        $user = User::where('mobile_token', $token)->first();
        if (is_null($user)) {
            return $this->response->array("1002");
        }
        if(!is_null($request->id) && $request->id > 0) { // Update
            $user =  User::where('id', $request->id)->first();
            if ($request->nom != "") $user->nom =  $request->nom;
            if ($request->prenom != "") $user->prenom =  $request->prenom;
            if ($request->societe != "") $user->societe =  $request->societe;
            if ($request->telephone != "") $user->telephone =  $request->telephone;
            if ($request->analytics != "") $user->analytics =  $request->analytics;
            if ($request->email != "") $user->email =  $request->email;
            if ($request->imap != "") $user->imap =  $request->imap;
            if ($request->password != "") $user->password =  bcrypt($request->password);
        } else { // Add
            $user = new User;
            $user->nom =  $request->nom;
            $user->prenom = $request->prenom;
            $user->societe = $request->societe;
            $user->telephone = $request->telephone;
            $user->analytics = $request->analytics;
            $user->email = $request->email;
            $user->imap = $request->imap;
            $user->type = 0;
            $user->password = bcrypt($request->password);
        }
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return $this->response->array("Veuillez vérifier votre adresse email.");
        }
        return $this->response->array($user->save() == 1 ? "true" : "false");
    }

    public function ws_delete_user($token, Request $request)
    {
        $user = User::where('mobile_token', $token)->first();
        if (is_null($user)) {
            return $this->response->array("1002");
        }
        $user =   $user = User::find($request->id);
        return $this->response->array($user->delete() == 1 ? "true" : "false");

    }
}