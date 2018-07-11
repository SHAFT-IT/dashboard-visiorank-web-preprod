<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;
use \Illuminate\Support\Facades\DB;

use Auth;
use Request;
use App\HistoriqueTicket;
use App\Ticket;

class DemandesController extends Controller
{
    use Helpers;

    /**
     * Get demandes by token
     * @param $token
     * @return mixed
     */
    public function index($token = null)
    {
        if (!$token) {
            return $this->response->array($this->getResponse(1001, 'Token invalide')); // Token invalid
        }

        $user = $this->getUserByToken($token);
        if ($user) {
            $tickets = $this->queryItems()->where('user_id', $user->id)->get();
            return $this->response->array($tickets);
        }
        return $this->response->array($this->getResponse(1002, 'Session vide')); // No session
    }

    public function queryItems()
    {
        return //Ticket::select('ticket_id', 'titre', 'description', 'date_creation', 'date_modification', 'statut_libelle as status', 'libelle as type', 'nom', 'prenom', 'priorite_libelle as priority', 'email')
            Ticket::select('*')
                ->where('tickets.visibilite', '=', '1')
                ->join('users as created', 'created.id', '=', 'tickets.created_by')
                ->join('type_tickets', 'type_tickets.type_id', '=', 'tickets.type')
                ->join('priorite_ticket', 'priorite_ticket.priorite_id', '=', 'tickets.ticket_priorite_id')
                ->join('statut_ticket', 'statut_ticket.statut_id', '=', 'tickets.ticket_last_status')
                ->leftjoin('historique_tickets', 'historique_tickets.historique_ticket', '=', 'tickets.ticket_id')
                ->groupBy('tickets.ticket_id')
                ->orderBy('date_creation', 'desc');
    }

    public function getById($token, $ticketId)
    {
        $user = $this->getUserByToken($token);
        if ($user) {
            $ticket = $this->queryItems()->where('ticket_id', $ticketId)->first();
            if ($ticket) {
                return $this->response->array($ticket);
            }
            return $this->response->array($this->getResponse(1003, 'Ticket introuvable')); // No session
        }
        return $this->response->array($this->getResponse(1002, 'Session vide')); // No session
    }

    /**
     * Get list type demandes
     * @return array
     */
    function getTypeList()
    {
        return DB::table('type_tickets')->get();
    }

    /**
     * Get list type demandes
     * @return array
     */
    function getPriorityList()
    {
        return DB::table('priorite_ticket')->get();
    }

    /**
     * Get list type statut
     * @return array
     */
    function getStatusList()
    {
        return DB::table('statut_ticket')->get();
    }

    public function updateStatus($token)
    {
        if (!$token) {
            return $this->response->array($this->getResponse(1001, 'Token invalide')); // Token invalid
        }
        $user = $this->getUserByToken($token);
        if (!$user) {
            return $this->response->array($this->getResponse(1002, 'Session vide'));
        }
        $ticketId = Request::input('ticketId');
        $ticket = Ticket::find($ticketId);
        if ($ticket) {
            $this->saveHistory($ticket, $ticketId, Request::input('statusId'), $user->id, Request::input('comment'));
        }
        return $this->response->array($this->getResponse(200, 'OK'));
    }

    function saveHistory($ticket, $ticketId, $statusId, $userId, $comment = "")
    {
        $ticket->ticket_last_status = $statusId;
        $ticket->save();
        $historique = new HistoriqueTicket();
        $historique->historique_ticket = $ticketId;
        $historique->historique_statut = $statusId;
        $historique->historique_date = new \DateTime();
        $historique->historique_comment = $comment;
        $historique->historique_by = $userId;
        $historique->save();

        //Send email
        if (\Config::get('constants.options.sd_send_mail') == 1)
            ServiceDeskMailerController::send_mail_historique($ticket, $historique);
    }

    public function edit()
    {

    }

    public function remove($token)
    {
        $user = $this->getUserByToken($token);
        if ($user) {
            $ticket = $this->queryItems()
                ->where('ticket_id', Request::input('ticketId'))
                ->where('user_id', $user->id)
                ->first();
            if ($ticket) {
                $ticket->visibilite = 0;
                $ticket->save();
            }
        }

        return $this->response->array("1001"); // No session
    }

    private function getUserByToken($token)
    {
        return User::where('mobile_token', $token)->first();
    }

    private function getResponse($code, $message)
    {
        $response = new \stdClass();
        $response->code = $code;
        $response->message = $message;
        return json_encode($response);
    }

}
