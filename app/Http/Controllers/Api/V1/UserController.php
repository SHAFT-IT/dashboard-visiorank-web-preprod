<?php
/**
 * Created by PhpStorm.
 * User: Tahiry
 * Date: 19/06/2018
 * Time: 13:30
 */

namespace App\Http\Controllers\Api\V1;


use App\User;
use Dingo\Api\Contract\Http\Request;
use Dingo\Api\Http\Response;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use Auth;


class UserController extends Controller {
    use Helpers;

    /*public function __construct()
    {
        // Only apply to a subset of methods.
        $this->middleware('api.auth', ['only' => ['get_all_user']]);
    }*/
    /**
     * Find All user
     * @url {BASE_URL}/public/api/get_all_user
     * @param Request $request
     * @return mixed
     */
    public function get_all_user(Request $request) {
        return $this->response->array(User::all()->toArray());
    }

    /**
     * Find user by id
     * @url {BASE_URL}/public/api/get_user_by_id/{id}
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function get_user_by_id (Request $request, $id){
        return $this->response->array(User::find($id));
    }
}