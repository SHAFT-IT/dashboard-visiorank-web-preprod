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
}