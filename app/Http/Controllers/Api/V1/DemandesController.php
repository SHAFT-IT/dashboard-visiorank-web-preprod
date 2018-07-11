<?php

namespace App\Http\Controllers\Api\V1;

use App\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\Routing\Controller;

use Auth;
use \Illuminate\Support\Facades\DB;
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
            return $this->response->array("1001"); // No session
        }

        $user = User::where('mobile_token', $token)->first();
        if ($user) {
            $tickets = $this->queryItems()->where('user_id', $user->id)->get();
            return $this->response->array($tickets);
        }
        return $this->response->array("1002"); // No session
    }

    public function queryItems()
    {
        return Ticket::select('titre', 'description', 'date_creation', 'date_modification', 'statut_libelle as status', 'libelle as type', 'nom', 'prenom', 'priorite_libelle as priority', 'email')
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
        $user = User::where('mobile_token', $token)->first();
        if ($user) {
            $ticket = $this->queryItems()->where('ticket_id', '=', $ticketId)->first();
            return $this->response->array($ticket);
        }
        return $this->response->array("1002"); // No session
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

    public function updateStatus()
    {

    }

    public function edit()
    {

    }

    public function remove()
    {

    }


}
