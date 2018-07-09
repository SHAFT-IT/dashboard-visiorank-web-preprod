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
        if(isset($results['items'])){
            $tProfiles = array();
            $profiles = array();
            foreach($results['items'] as $profile){
                $profiles[$profile['id']] = $profile['websiteUrl'];
            }
            array_push($tProfiles, $profiles);
        }

        return $this->response->array($tProfiles);
    }
}