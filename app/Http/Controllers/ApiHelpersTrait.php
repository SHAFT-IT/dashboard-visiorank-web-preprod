<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 12/07/2018
 * Time: 17:42
 */

namespace App\Http\Controllers;


trait ApiHelpersTrait
{
    private function getResponse($code, $message = '')
    {
        $response = new \stdClass();
        $response->code = $code;
        $response->message = $message;
        return json_encode($response);
    }

    private function getLoginResponse($code, $message = '', $user)
    {
        $response = new \stdClass();
        $response->code = $code;
        $response->message = $message;
        $response->user = $user;
        return json_encode($response);
    }


}
