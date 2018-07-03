<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use App\Extra\ImapAPI;
use Auth;
use App\Appel;

ini_set('max_execution_time', -1);

class MessagesController extends Controller {
    use Helpers;

     /**
     * params: token
     * return: Json Array
     * url {BASE_URL}/api/ws_get_messages/{token}
     */
    public function ws_get_messages($token) { 
        $user = session()->get("user_mobile");
        if (is_null($user)) {
            return $this->response->array ("1002"); // No session
        }
        $messages = array();
        if($user) {
            if($user->email != "" && $user->imap != ""){
                $messages = ImapAPI::getMessages("{SSL0.OVH.NET:143/imap}", $user->email, $user->imap);
            }
        }
        return $this->response->array ($messages);
    }
}