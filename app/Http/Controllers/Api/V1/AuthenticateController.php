<?php
/**
 * Created by PhpStorm.
 * User: Tahiry
 * Date: 02/07/2018
 * Time: 15:33
 */

namespace App\Http\Controllers\Api\V1;
use App\User;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use App\Http\Controllers\ApiHelpersTrait;

use Auth;

class AuthenticateController extends Controller {
    use Helpers,  ApiHelpersTrait;

    /**
     * @param Request $request
     * @return mixed
     */
    public function ws_login(Request $request) {
        if (Auth::attempt(array('email' => $request->email, 'password' => $request->password))) {
            $user = User::where('email', $request->email )->first();
            if (is_null($user))
                return $this->response->array($this->getResponse(1004, 'No user'));

            $user->mobile_token = md5($request->email . time());
            session()->put('user_mobile', $user);
            $user->save();
            return $this->response->array ($user);
        }
        return $this->response->array($this->getResponse(1001, 'Login ou mot de passe incorrect'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function ws_logout (Request $request){
        $user = session()->get("user_mobile");
        if (is_null($user))
            return $this->response->array ("1002"); // No session

        $user = User::where('mobile_token', $request->token)->first();

        if (isset ($user) && !is_null($user->mobile_token) && $request->token == $user->mobile_token){
            $user->mobile_token = null;
            $user->save();
            session()->put("user_mobile", null);
        }else{
            return $this->response->array ("1003"); // Erreur lors de la deconnexion
        }
        return $this->response->array (true); // Login mot de passe incorrect
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function ws_get_connected_user (Request $request){
        $user = session()->get("user_mobile");
        if (is_null($user))
            return $this->response->array ("1002"); // No session

        $user = User::where('mobile_token', $request->token )->first();
        if ($request->token != $user->mobile_token)
            return $this->response->array ("1004"); // Erreur token

        return $this->response->array ($user);
    }
}