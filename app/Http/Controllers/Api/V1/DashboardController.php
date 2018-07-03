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
ini_set('max_execution_time', -1);

class DashboardController extends Controller {
    use Helpers;

    /**
     * params: token
     * return: Json Array
     * url {BASE_URL}/api/ws_get_data_dashboard/{token}
     */
    public function ws_get_data_dashboard($token) { 
        $user = session()->get("user_mobile");
        if (is_null($user))
            return $this->response->array ("1002"); // No session
        $user = User::where('mobile_token', $token)->first();

        $client_id = \Config::get('constants.ws.ga_client_id');
        $client_mail = \Config::get('constants.ws.ga_client_mail');
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
            return $this->response->array ($e->getMessage()); 
        }
        // Try to get the AccessToken
        if ($auth['http_code'] == 200) {
            $accessToken = $auth['access_token'];
            $tokenExpires = $auth['expires_in'];
            $tokenCreated = time();
        } else {
            return $this->response->array ("Sorry, something wend wrong retrieving the oAuth tokens : " . $auth['http_code']); 
        }

        // Set the accessToken and Account-Id
        $ga->setAccessToken($accessToken);
        if($user) {
            // Load profiles
            $profilId = "ga:" . $user->analytics;
            if ($profilId != "ga:") {
                $ga->setAccountId($profilId);
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
                    $calls[] = $call;
                }
            }
            if($user->email != "" && $user->imap != ""){
                $messages = ImapAPI::getUnseenMessages("{SSL0.OVH.NET:143/imap}", $user->email, $user->imap);
            }
			// Demande dans dashboard
            $nbTicket = ServiceDeskController::countTicketByUser ($user->id);
        }
        $tDashboard = array ();
        array_push($tDashboard, intval($visits), sizeof($calls), intval($messages), $nbTicket); 
        return $this->response->array ($tDashboard);
    }
}

