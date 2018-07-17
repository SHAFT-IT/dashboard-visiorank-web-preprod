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

    function toDateSQL($date)
    {
        $zDate = trim($date);
        $separator = strrpos($zDate, "/") ? '/' : '-';
        $tD = explode($separator, $zDate);
        if ($tD[0] <> "") {
            return $tD[2] . "-" . $tD[1] . "-" . $tD[0];
        }
        return "NULL";
    }

    function toDateFR($date)
    {
        $date = trim($date);
        if (strlen($date) >= 10 && $date != "0000-00-00 00:00:00") {
            $date = substr($date, 0, 10);
            $tD = explode('-', $date);
            return $tD[2] . "/" . $tD[1] . "/" . $tD[0];
        }
        return "";
    }
}
