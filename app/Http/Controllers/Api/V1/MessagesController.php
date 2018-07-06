<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use App\Extra\ImapAPI;
use Auth;

ini_set('max_execution_time', -1);

class MessagesController extends Controller {
    use Helpers;

     /**
     * params: token
     * return: Json Array
     * url {BASE_URL}/api/ws_get_messages/{token}
     */
    public function ws_get_messages($token) {
        $user = User::where('mobile_token', $token)->first();
        if (is_null($user)) {
            return $this->response->array ("1002"); // No session
        }
        $messages = array();
        if($user) {
            if($user->email != "" && $user->imap != ""){
                $messages = ImapAPI::getMessages("{SSL0.OVH.NET:143/imap}", $user->email, $user->imap);
                usort($messages,'sort_by_timestamp');
            }
        }
        return $this->response->array ($messages);
    }

    private function sort_by_timestamp( $a, $b )
    {
        if(  $a->udate ==  $b->udate ){ return 0 ; }
        return ($a->udate < $b->udate) ? -1 : 1;
    }
}