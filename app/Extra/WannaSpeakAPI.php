<?php

namespace App\Extra;


use Nathanmac\Utilities\Parser\Parser;

class WannaSpeakAPI
{

    const API_URL = "https://www-2.wannaspeak.com/api/api.php?";

    protected $accountId;
    protected $accountKey;

    public function __construct($id, $key){
        $this->accountId = $id;
        $this->accountKey = $key;
    }

    public function getListeAppels($debut = null, $fin = null){
        if($debut){
            $start = $debut;
        }else{
            $start = date('Y-m-01 00:00', strtotime('-30 days'));
        }

        if($fin){
            $stop = $fin;
        }else{
            $stop = date('Y-m-d 23:59');
        }

        $now = time();

        $authKey = $now . '-' . md5($this->accountId . $now . $this->accountKey);
        try {
            $stats = file_get_contents(self::API_URL . "api=stat&id=" . $this->accountId . "&key=" . $authKey . "&method=did&starttime=" . urlencode($start) . "&stoptime=" . urlencode($stop) . "&format=xml&nodid=1");

            $parser = new Parser();
            $parsed = $parser->xml($stats);

            if($parsed['error']){
                $tmp = str_replace(" +- 10s", "", str_replace("Time error, more than UnixTimestamp NOW() ", "", $parsed['error']['txt']));
                $now = $tmp + 5;
                $authKey = $now . '-' . md5($this->accountId . $now . $this->accountKey);
                $stats = file_get_contents(self::API_URL . "api=stat&id=" . $this->accountId . "&key=" . $authKey . "&method=did&starttime=" . urlencode($start) . "&stoptime=" . urlencode($stop) . "&format=xml&nodid=1");

                $parsed = $parser->xml($stats);
            }

            return $parsed['data']['calls']['call'];
        }catch (\Exception $e){
            return array();
        }
    }

}