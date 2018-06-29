<?php
/*
 * Created by PhpStorm.
 * User: Tahiry
 * Date: 01/06/2018
 * Time: 15:47
 */

namespace App\Http\Controllers;

use App\Appel;
use App\Bill;
use App\Extra\GoogleAnalyticsAPI;
use App\Extra\ImapAPI;
use App\Extra\WannaSpeakAPI;
use App\HistoriqueTicket;
use App\Pays;
use App\PjTicket;
use App\Ticket;
use App\TypeTickets;
use App\User;
use Validator;
use Request;
use Storage;
use Auth;
use Session;
use File;
use DateTime;
use Input;
use Mail;
use DateInterval;
use Nathanmac\Utilities\Parser\Parser;
use \Illuminate\Http\Response;
use \Illuminate\Routing\ResponseFactory;
use \Illuminate\Support\Facades\DB;
use \Illuminate\Pagination\Paginator;


class ServiceDeskController extends Controller {
    /*
     * Contructor
     */
    public function __construct(){

        $this->middleware('auth', ['except' => ['login', 'logout']]);
    }

    /**
     * Get all ticket
     * @return \Illuminate\View\View
     */
    function ticket(){
        //Find ticket with filter
        $oTicket = Ticket::where('visibilite', '=', 1)
            ->where(
                function($query){
                    // Find by user
                    $user_id = 0;
                    if(Auth::user()->type == 0){
                        $user = Auth::user();
                    }elseif(Auth::user()->type == 1) {
                        $user = User::find(session()->get('user', 0));
                    }
                    if (!is_null($user)){
                        $user_id = $user['original']['id'];
                    }
                    if ($user_id > 0){
                        $query->where('user_id', '=', $user_id);
                    }
                    // Date filter
                    if (Request::input('date1') != "" && Request::input('date2') != "") {
                        $date1 = $this->toDateSQL(Request::input('date1')) . " 00:00:00";
                        $date2 = $this->toDateSQL(Request::input('date2')) . " 23:59:59";
                        $query->whereBetween('date_creation', [$date1, $date2]);
                        //$query->whereBetween('date_modification', [$date_from, $date_to]);
                    }

                    // Titre filter
                    if (Request::input('titre') != "") {
                        $query->where('titre', 'like', '%' . Request::get('titre') . '%');
                    }

                    // Type filter
                    if (Request::input('type') > 0) {
                        $query->where('tickets.type', '=', Request::get('type'));
                    }
                    // Status filter
                    if (Request::input('statut') > 0){
                        $query->where('ticket_last_status', '=', Request::input('statut'));
                    }

                    if (Request::input('priorite') > 0) {
                        $query->where('priorite_ticket.priorite_id', '=', Request::get('priorite'));
                    }
                }
            )
            ->selectRaw ('*, users.*, created.id as created_id, created.nom as created_nom, created.prenom as created_prenom')
            ->join('users as users', 'users.id', '=', 'tickets.user_id')
            ->join('users as created', 'created.id', '=', 'tickets.created_by')
            ->join('type_tickets', 'type_tickets.type_id', '=', 'tickets.type')
            ->join('priorite_ticket', 'priorite_ticket.priorite_id', '=', 'tickets.ticket_priorite_id')
            ->join('statut_ticket', 'statut_ticket.statut_id', '=', 'tickets.ticket_last_status')
            ->leftjoin ('historique_tickets', 'historique_tickets.historique_ticket', '=', 'tickets.ticket_id')
            ->groupBy ('tickets.ticket_id')
            ->orderBy ('date_creation', 'desc')
            ->paginate(\Config::get('constants.options.nombre_par_page'))
            ->setPath('ticket');

        return view('dashboard.sd_ticket')->with(array(
            'oTicket' => $oTicket,
            'oTypeTicket' => $this->getTypeList(),
            'oPrioriteTicket' => $this->getPrioriteList(),
            'request' => Request::input(),
            'oStatutList' => $this->getStatutList()
        ));
    }

    static function countTicketByUser ($user_id){
        $nbTicket = Ticket::where('visibilite', '=', 1)
            ->where(
                function($query) use ($user_id){
                    $query->where('user_id', '=', $user_id);
                }
            )
            ->selectRaw ('count(ticket_id) as nbTicket')
            //->groupBy ('tickets.ticket_id')
            ->get();
        if (!is_null($nbTicket) && isset ($nbTicket[0]))
            return $nbTicket[0]->nbTicket;

        return 0;
    }
    /**
     * Get ticket by Id
     * @param null $id
     * @return \Illuminate\View\View
     */
    function edit_ticket ($id=null)
    {
        // Utilisateur connecté ou gardé en session
        if (Auth::user()->type == 0)
            $user = Auth::user();
        else
            $user = User::find(session()->get('user', 0));

        return view('dashboard.sd_edit_ticket')->with(array(
            'ticket' => Ticket::find($id),
            'oTypeTicket' => $this->getTypeList(),
            'oPrioriteTicket' => $this->getPrioriteList(),
            'toUser' => $this->getUserList(),
            'user' => $user,
            'id' => $id,
            'toHistoriqueTicket' => $this->getHistoriqueByTicket($id),
            'oStatutList' => $this->getStatutList(),
            'toPj' => $this->getPjByTicket($id)
        ));
    }

    /**
     * @param $ticket_id
     * @return mixed
     */
    function getPjByTicket($ticket_id){
        // pj_visibilite
        $toPjTicket = PjTicket::where('pj_visibilite', '=', 1)
            ->where (
                function ($query) use ($ticket_id){
                    $query->where('pj_tickets.pj_ticket', '=', $ticket_id);
                }
            )
            ->join('tickets', 'tickets.ticket_id', '=', 'pj_tickets.pj_ticket')
            ->orderBy ('pj_date', 'desc')
            ->get();

        foreach ($toPjTicket as $oPjTicket){
            $oPjTicket->icon = 'fa-file-o';
            if (isset($oPjTicket->pj_file) && $oPjTicket->pj_file != ""){
                $oPjTicket->icon = $this->getIconByFileMimeType(mime_content_type(public_path(). "/uploads/" . $oPjTicket->pj_file));
            }
        }
        return $toPjTicket ;
    }

    /**
     * @param $ticket_id
     * @return mixed
     */
    function getHistoriqueByTicket ($ticket_id){
        return HistoriqueTicket::where('historique_visibilite', '=', 1)
            ->where(
                function ($query) use ($ticket_id){
                    $query->where('historique_ticket', '=', $ticket_id);
                }
            )
            ->leftjoin('users', 'users.id', '=', 'historique_tickets.historique_by')
            ->join('statut_ticket', 'statut_ticket.statut_id', '=', 'historique_tickets.historique_statut')
            ->orderBy ('historique_date', 'desc')
            ->get();
    }
    /*
     * Save ticket
     */
    function save_ticket(){
        $inputs = Request::all();
        $rules = array(
           'titre' => 'required'
         );
        $validation = Validator::make($inputs, $rules);
        if ($validation->fails()) {
            return redirect()->back()->withInput()->withErrors($validation)->with('alert_error', 'Veuillez corriger les erreurs');
        }

        $isNewTicket = false;
        if(Request::input('ticket_id')){
            $ticket = Ticket::find(Request::get('ticket_id'));
            if (!$ticket) {
                return redirect()->action('ServiceDeskController@edit_ticket')->withInput()->with('alert_error', "Une erreur est survenue lors de l'enregistrement");
            }
            $ticket->date_modification = DateTime::createFromFormat("Y-m-d", date('Y-m-d', strtotime('-30 days')));;
        }else{
            $isNewTicket = true;
            $ticket = new Ticket();
            $ticket->date_creation = DateTime::createFromFormat("Y-m-d", date('Y-m-d', strtotime('-30 days')));
            $ticket->date_modification = null;
            $ticket->type = Request::get('type');
            $ticket->user_id = Request::get('user_id');
            $ticket->created_by = Auth::user()->id;
        }

        $ticket->titre = Request::get('titre');
        $ticket->description = Request::get('description');
        $ticket->ticket_priorite_id = Request::get('ticket_priorite_id');
        $ticket->save();

        if (Request::get('uploadedfiles') != ""){
            $this->save_pj_ticket (Request::get('uploadedfiles'), $ticket->ticket_id);
        }
        //Save Historique Statut ouvert
        if ($isNewTicket){
            $this->save_historique($ticket->ticket_id, 1);
        }
        //Send email
        if (\Config::get('constants.options.sd_send_mail') == 1)
            ServiceDeskMailerController::send_mail_edition_ticket($ticket, $isNewTicket);

        return redirect()->action('ServiceDeskController@ticket');
    }

    /**
     * Save Historique
     * @param $ticket_id
     * @param $status_id
     * @return redirect ServiceDeskController@ticket
     */
    function save_historique ($ticket_id, $status_id, $bRedirect=0, $comment = ""){
        $ticket = Ticket::find($ticket_id);
        $ticket->ticket_last_status = $status_id;
        $ticket->save();

        $historique = new HistoriqueTicket();
        $historique->historique_ticket = $ticket_id ;
        $historique->historique_statut = $status_id;
        $historique->historique_date = new DateTime();
        $historique->historique_comment = $comment;
        $historique->historique_by = Auth::user()->id;
        $historique->save();

        //Send email
        if (\Config::get('constants.options.sd_send_mail') == 1)
            ServiceDeskMailerController::send_mail_historique($ticket, $historique);

        if ($bRedirect){ // Recirection vers la fiche
            return redirect()->action('ServiceDeskController@edit_ticket', array('id'=>$ticket_id));
        }
        return redirect()->action('ServiceDeskController@ticket');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    function save_historique_comment (){
        $ticket = Ticket::find(Request::get('id'));
        $ticket->ticket_last_status = Request::get('status') ;
        $ticket->save();

        $historique = new HistoriqueTicket();
        $historique->historique_ticket = Request::get('id') ;
        $historique->historique_statut = Request::get('status');
        $historique->historique_date = new DateTime();
        $historique->historique_comment = Request::get('comment');
        $historique->historique_by = Auth::user()->id;
        $historique->save();

        //Send email
        if (\Config::get('constants.options.sd_send_mail') == 1)
            ServiceDeskMailerController::send_mail_historique($ticket, $historique);

        return "OK";
    }

    /**
     * Delete ticket
     * @param null $id
     * @return \Illuminate\Http\RedirectResponse
     */
    function delete_ticket ($id=null){
        $ticket = Ticket::find($id);
        if (!$ticket)
            return redirect()->action('ServiceDeskController@ticket')->withInput()->with('alert_error', "Une erreur est survenue lors de la suppression");
        $ticket->visibilite = 0;
        $ticket->save();
        return redirect()->action('ServiceDeskController@ticket');
    }

    /**
     * Delete pièce jointe
     * @param null $idpj id pj
     * @param $id id ticket
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete_pj_ticket ($idpj=null, $id=null){
        $oPj = PjTicket::find($idpj);
        if (!$oPj)
            return redirect()->action('ServiceDeskController@edit_ticket', array('id' => $id))->withInput()->with('alert_error', "Une erreur est survenue lors de la suppression");
        $oPj->pj_visibilite = 0;
        $oPj->save();
        return redirect()->action('ServiceDeskController@edit_ticket', array('id' => $id));
    }

    /**
     * @param $pj
     * @param $ticket_id
     * @return bool
     */
    function save_pj_ticket ($pj, $ticket_id){
        $tPj = explode(";", $pj);
        if (sizeof($tPj) > 0){
            foreach ($tPj as $sPj){
                if ($sPj != ""){
                    $newPj = new PjTicket();
                    $newPj->pj_ticket = $ticket_id;
                    $newPj->pj_file = $sPj;
                    $newPj->pj_date = new DateTime();
                    $newPj->pj_visibilite = 1;
                    $newPj->save();
                }
            }
        }
        return true;
    }

    /**
     * @param $file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download_pj_ticket($file){
        return response()->download(
            public_path(). "/uploads/" . $file,
            $file,
            [ 'Content-Type: ' . mime_content_type(public_path(). "/uploads/" . $file) ]
        );
    }
    /**
     *
     * UTILS FUNCTION
     *
     *
     */
    function getIconByFileMimeType($mime_type) {
        // List of official MIME Types: http://www.iana.org/assignments/media-types/media-types.xhtml
        $icon_classes = array(
            // Media
            'image' => 'fa-file-image-o',
            'audio' => 'fa-file-audio-o',
            'video' => 'fa-file-video-o',
            // Documents
            'application/pdf' => 'fa-file-pdf-o',
            'application/msword' => 'fa-file-word-o',
            'application/vnd.ms-word' => 'fa-file-word-o',
            'application/vnd.oasis.opendocument.text' => 'fa-file-word-o',
            'application/vnd.openxmlformats-officedocument.wordprocessingml' => 'fa-file-word-o',
            'application/vnd.ms-excel' => 'fa-file-excel-o',
            'application/vnd.openxmlformats-officedocument.spreadsheetml' => 'fa-file-excel-o',
            'application/vnd.oasis.opendocument.spreadsheet' => 'fa-file-excel-o',
            'application/vnd.ms-powerpoint' => 'fa-file-powerpoint-o',
            'application/vnd.openxmlformats-officedocument.presentationml' => 'fa-file-powerpoint-o',
            'application/vnd.oasis.opendocument.presentation' => 'fa-file-powerpoint-o',
            'text/plain' => 'fa-file-text-o',
            'text/html' => 'fa-file-code-o',
            'application/json' => 'fa-file-code-o',
            // Archives
            'application/gzip' => 'fa-file-archive-o',
            'application/zip' => 'fa-file-archive-o',
        );
        foreach ($icon_classes as $text => $icon) {
            if (strpos($mime_type, $text) === 0) {
                return $icon;
            }
        }
        return 'fa-file-o';
    }

    public function uploadFiles() {
        $input = Input::all();
        $destinationPath = 'uploads'; // upload path
        //$extension = Input::file('file')->getClientOriginalExtension(); // getting file extension
        //$fileName = rand(11111, 99999) . '.' . $extension; // renameing image
        $originalName = Input::file('file')->getClientOriginalName();
        $upload_success = Input::file('file')->move($destinationPath, $originalName); // uploading file to given path

        return $originalName;
    }

    /**
     * Get list type demandes
     * @return array
     */
    function getTypeList (){
        return DB::table('type_tickets')->get();
    }

    /**
     * Get list type demandes
     * @return array
     */
    function getPrioriteList (){
        return DB::table('priorite_ticket')->get();
    }

    /**
     * Get list type statut
     * @return array
     */
    function getStatutList (){
        return DB::table('statut_ticket')->get();
    }

    /**
     * @return mixed
     */
    function getUserList (){
        $toUser = array ();
        $toUser = DB::table('users')
            ->where("type", "=", 0)
            ->get();
        return $toUser;
    }
    /**
     * Fonction de formatage de date FR en date EN (format mysql)
     *
     * @param		string	$_zDatefr	Date FR
     * @return	string	$zDatesql	Date UK (ou NULL)
     */
    function toDateSQL($_zDatefr) {
        $zDate =  trim($_zDatefr);

        $zSeparateur = strrpos( $zDate, "/")?'/':'-';

        $tD = explode($zSeparateur,$zDate);

        if ($tD[0]<>"") {
            $zDatesql = $tD[2]."-".$tD[1]."-".$tD[0];
            return $zDatesql;
        }
        return "NULL";
    }  // FIN : toDateSQL()

    /**
     * Fonction de formatage de date format mysql en date FR
     *
     * @param		string	$_zDatesql	Date FR
     * @return	string	$zDatefr		Date FR (ou cha?ne vide)
     */

    function toDateFR($_zDatesql) {
        $_zDatesql = trim($_zDatesql);
        if (strlen($_zDatesql)>=10 && $_zDatesql!="0000-00-00 00:00:00") {
            $_zDatesql = substr($_zDatesql, 0,10);
            $tD = explode('-',$_zDatesql);
            //print_r($d);
            $zDatefr = $tD[2]."/".$tD[1]."/".$tD[0];
            return $zDatefr;
        }
        return "";
    }  // FIN : toDateFR()

}