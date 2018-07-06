<?php

namespace App\Http\Controllers\Api\V1;

use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use App\Extra\WannaSpeakAPI;
use Auth;
use App\Appel;

ini_set('max_execution_time', -1);

class CallsController extends Controller {
    use Helpers;

     /**
     * params: token
     * return: Json Array
     * url {BASE_URL}/api/ws_get_calls/{token}
     */
    public function ws_get_calls($token) { 
        $user = session()->get("user_mobile");
        if (is_null($user)) {
            return $this->response->array ("1002"); // No session
        }
        $calls = array();
        if($user) {
            $wanna = new WannaSpeakAPI("0461851371", "6194134591");
            $tmp = $wanna->getListeAppels();
            foreach ($tmp as $call) {
                if ($call['inbound'] == $user->telephone) {
                    $calls[] = $call;
                }
            }

            foreach ($calls as $key => $call) {
                $id = md5($call['starttime'] . $call['inbound']);
                $appel = Appel::find($id);
                if ($appel == null) {
                    $appel = new Appel;
                    $appel->id = $id;
                    $appel->pertinant = 1;
                    $appel->save();
                }
                $calls[$key]['pertinant'] = $appel->pertinant;
                $t = round($call['duration']);
                $calls[$key]['duration'] = sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
                $calls[$key]['source'] = preg_replace('/^33/', '0', $call['source'], 1);
                $calls[$key]['id'] = $id;
            }
            array_multisort($calls, SORT_DESC);
        }
        return $this->response->array ($calls);
    }
}