<?php
/**
 * Created by PhpStorm.
 * User: Tahiry
 * Date: 28/06/2018
 * Time: 10:24
 */

namespace App\Http\Controllers;
use Mail;
use App\User;

class ServiceDeskMailerController extends Controller {
    /*
     * Contructor
     */
    public function __construct(){

        $this->middleware('auth', ['except' => ['login', 'logout']]);
    }

    /**
     * Mail de test
     */
    static function sendEmailTest()
    {
        $user = User::find(135);

        Mail::send('mail.test', ['user' => $user], function ($m) use ($user) {
            $m->from('no-reply@visiorank.net', 'Dashboard Visiorank');
            $m->to("t.randriambola@gmail.com", $user->nom)->subject('Mail de test Dashboard Visiorank!');
        });
    }

    /**
     * Send mail edition ticket
     * @param $oTicket
     * @param $isNewTicket
     */
    static function send_mail_edition_ticket ($oTicket, $isNewTicket){
        $oUserTicket = User::find($oTicket->user_id);
        $oConnectedUser = User::find($oTicket->created_by);
        $tData = array ('isNewTicket' => $isNewTicket, 'oTicket' => $oTicket, 'oConnectedUser' => $oConnectedUser, 'oUserTicket' => $oUserTicket);
        $subject = sprintf(\Config::get('constants.options.sd_mail_subject_modif_ticket'), $oTicket->titre) ;
        if ($isNewTicket)
            $subject = \Config::get('constants.options.sd_mail_subject_new_ticket') ;

        Mail::send('mail.edit_ticket', $tData, function ($msg) use ($oUserTicket, $isNewTicket, $subject) {
            $msg
                ->from(\Config::get('constants.options.sd_mail_from_mail'), \Config::get('constants.options.sd_mail_from_name'))
                ->to($oUserTicket->email, $oUserTicket->prenom . ' ' . $oUserTicket->nom)
                ->subject($subject)
                ->cc(['didier.houssin@shaft-it.com','tahiry.randriambola@shaft-it.com']);
        });
    }

    /**
     *
     * @param $oTicket
     * @param $oHistorique
     */
    static function send_mail_historique ($oTicket, $oHistorique){
        $oUserTicket = User::find($oTicket->user_id);
        $oConnectedUser = User::find($oHistorique->historique_by);
        $tData = array ('oConnectedUser' => $oConnectedUser, 'oTicket' => $oTicket, 'oHistorique' => $oHistorique, 'oUserTicket' => $oUserTicket);

        Mail::send('mail.historique_ticket', $tData, function ($msg) use ($oUserTicket, $oTicket) {
            $msg
                ->from(\Config::get('constants.options.sd_mail_from_mail'), \Config::get('constants.options.sd_mail_from_name'))
                ->to($oUserTicket->email, $oUserTicket->prenom . ' ' . $oUserTicket->nom)
                ->subject(sprintf(\Config::get('constants.options.sd_mail_subject_status_changed'), $oTicket->titre))
                ->cc(['didier.houssin@shaft-it.com','tahiry.randriambola@shaft-it.com']);
        });
    }
}