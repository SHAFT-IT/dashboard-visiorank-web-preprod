<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use App\Extra\ImapAPI;
use Auth;
use Dingo\Api\Contract\Http\Request;

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
                $messages = array_reverse($messages);
            }
        }
        return $this->response->array ($messages);
    }

    public function ws_details_message($token, Request $request) {
        $user = User::where('mobile_token', $token)->first();
        if (is_null($user))
            return $this->response->array ("1002");
        $id = $request->id;
        $message = ImapAPI::getMessage("{SSL0.OVH.NET:143/imap}", $user->email, $user->imap, $id);
        return $this->response->array($message);
    }
}


