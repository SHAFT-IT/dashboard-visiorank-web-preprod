<?php

namespace App\Http\Controllers\Api\V1;

use App\HistoriqueTicket;
use App\Http\Controllers\ApiHelpersTrait;
use App\PjTicket;
use App\Ticket;
use App\User;
use Auth;
use Dingo\Api\Routing\Helpers;
use Illuminate\Http\Request as FileRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Request;

class DemandesController extends Controller
{
    use Helpers, ApiHelpersTrait;

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
            $query = $this->queryItems();
            if ((int)$user->type !== 1) {
                $query = $query->where('user_id', $user->id);
            }
            return $this->response->array($query->get());
        }
        return $this->response->array($this->getResponse(1002, 'Session vide')); // No session
    }

    public function queryItems()
    {
        return Ticket::select('type_id', 'statut_id', 'priorite_id', 'user_id', 'historique_comment as comment', 'ticket_id', 'titre', 'description', 'date_creation', 'date_modification', 'statut_libelle as status', 'libelle as type', 'nom', 'prenom', 'priorite_libelle as priority', 'email')
            //Ticket::select('*')
            ->where('tickets.visibilite', '=', '1')
            ->join('users as created', 'created.id', '=', 'tickets.created_by')
            ->join('type_tickets', 'type_tickets.type_id', '=', 'tickets.type')
            ->join('priorite_ticket', 'priorite_ticket.priorite_id', '=', 'tickets.ticket_priorite_id')
            ->join('statut_ticket', 'statut_ticket.statut_id', '=', 'tickets.ticket_last_status')
            ->leftjoin('historique_tickets', 'historique_tickets.historique_ticket', '=', 'tickets.ticket_id')
            ->groupBy('tickets.ticket_id')
            ->orderBy('date_modification', 'desc')
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

    public function filter($token)
    {
        if (!$token) {
            return $this->response->array($this->getResponse(1001, 'Token invalide')); // Token invalid
        }

        $user = $this->getUserByToken($token);
        if (!$user) {
            return $this->response->array($this->getResponse(1002, 'Session vide'));
        }

        $query = $this->queryItems();

        if ((int)$user->type !== 1) {
            $query = $query->where('user_id', $user->id);
        }

        // Date filter
        if (Request::input('date1') != "" && Request::input('date2') != "") {
            $date1 = $this->toDateSQL(Request::input('date1')) . " 00:00:00";
            $date2 = $this->toDateSQL(Request::input('date2')) . " 23:59:59";
            $query->whereBetween('date_creation', [$date1, $date2]);
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
        if (Request::input('statut') > 0) {
            $query->where('ticket_last_status', '=', Request::input('statut'));
        }

        if (Request::input('priorite') > 0) {
            $query->where('priorite_ticket.priorite_id', '=', Request::get('priorite'));
        }

        return $this->response->array($query->get());
    }

    public function edit(FileRequest $request, $token)
    {
        if (!$token) {
            return $this->response->array($this->getResponse(1001, 'Token invalide')); // Token invalid
        }

        $user = $this->getUserByToken($token);
        if (!$user) {
            return $this->response->array($this->getResponse(1002, 'Session vide'));
        }

        $ticket = Ticket::find(Request::input('ticketId'));

        if ($ticket) {
            $ticket->titre = Request::input('titre');
            $ticket->description = Request::input('description');
            $ticket->ticket_priorite_id = Request::input('priorityId');
            $ticket->user_id = Request::input('userId');
            $ticket->date_modification = new \DateTime();
            $ticket->save();

            if ($paths = $this->sendFiles($request)) {
                $this->saveAttachments($paths, $ticket->ticket_id);
            }

            return $this->response->array($this->getResponse(200, 'OK'));
        }

        return $this->response->array($this->getResponse(100, 'Unknown'));
    }

    function getTicketAttachments($ticketId)
    {
        $toPjTicket = PjTicket::where('pj_visibilite', '=', 1)
            ->where(
                function ($query) use ($ticketId) {
                    $query->where('pj_tickets.pj_ticket', '=', $ticketId);
                }
            )
            ->join('tickets', 'tickets.ticket_id', '=', 'pj_tickets.pj_ticket')
            ->orderBy('pj_date', 'desc')
            ->get();

        foreach ($toPjTicket as $oPjTicket) {
            $oPjTicket->icon = 'fa-file-o';
            if (isset($oPjTicket->pj_file) && $oPjTicket->pj_file != "") {
                $oPjTicket->icon = $this->getIconByFileMimeType(mime_content_type(public_path() . "/uploads/" . $oPjTicket->pj_file));
            }
        }
        return $toPjTicket;
    }

    function saveAttachments($fileNames, $ticketId)
    {
        foreach ($fileNames as $fileName) {
            if ($fileName != "") {
                $newPj = new PjTicket();
                $newPj->pj_ticket = $ticketId;
                $newPj->pj_file = $fileName;
                $newPj->pj_date = new \DateTime();
                $newPj->pj_visibilite = 1;
                $newPj->save();
            }
        }
    }

    public function post(FileRequest $request, $token)
    {
        if (!$token) {
            return $this->response->array($this->getResponse(1001, 'Token invalide')); // Token invalid
        }

        $user = $this->getUserByToken($token);
        if (!$user) {
            return $this->response->array($this->getResponse(1002, 'Session vide'));
        }

        $ticket = new Ticket();
        $ticket->titre = Request::input('titre');
        $ticket->description = Request::input('description');
        $ticket->ticket_priorite_id = Request::input('priorityId');
        $ticket->user_id = Request::input('userId');
        $ticket->type = Request::input('type');
        $ticket->date_creation = new \DateTime();
        $ticket->save();

        if ($paths = $this->sendFiles($request)) {
            $this->saveAttachments($paths, $ticket->ticket_id);
        }

        return $this->response->array($this->getResponse(200, 'OK'));
    }

    public function remove($token)
    {
        $user = $this->getUserByToken($token);
        if ($user) {
            $ticket = Ticket::where('ticket_id', Request::input('ticketId'))
                ->where('user_id', $user->id)
                ->first();
            if ($ticket) {
                $ticket->visibilite = 0;
                $ticket->save();
                return $this->response->array($this->getResponse(200, 'success'));
            }
            return $this->response->array($this->getResponse(1002, 'Ticket not found'));
        }
        return $this->response->array($this->getResponse(1002, 'Session vide')); // No session
    }

    private function getUserByToken($token)
    {
        return User::where('mobile_token', $token)->first();
    }

}
