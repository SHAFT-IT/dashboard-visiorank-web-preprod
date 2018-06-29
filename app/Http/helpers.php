<?php

function formatSeconds($seconds){
    $t = round($seconds);
    return sprintf('%02d:%02d:%02d', ($t/3600),($t/60%60), $t%60);
}

function setDate($date, $interval = 'PT1H'){
    $tmp = DateTime::createFromFormat('Y-m-d H:i:s', $date)->add(new DateInterval($interval));
    return $tmp->format('d/m/Y à H:i:s');
}


function getHeure($date, $interval = 'PT1H'){
    $tmp = DateTime::createFromFormat('Y-m-d H:i:s', $date)->add(new DateInterval($interval));
    return $tmp->format('H');
}

function setTerminatedCause($call){
    $return = "success";
    if($call['terminatecause'] != "ANSWER"){
        $return = "danger";
    }else{
        if($call['duration'] < 10){
            $return = "warning";
        }
    }
    return $return;
}

function getUsers(){
    $users = array(0 => "Choisissez un utilisateur");
    $tmp = \App\User::where('type', '=', 0)
        ->orderBy ('societe' ,'ASC')
        ->get();
    foreach($tmp as $user){
        $users[$user->id] = $user->societe . " - " . $user->nom . " " . $user->prenom;
    }
    return $users;
}