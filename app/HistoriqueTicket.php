<?php
/**
 * Created by PhpStorm.
 * User: Tahiry
 * Date: 07/06/2018
 * Time: 10:01
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class HistoriqueTicket extends Model {
    public $primaryKey = "historique_id";

    public $timestamps = array();
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['historique_ticket', 'historique_statut', 'historique_by', 'historique_date', 'historique_comment', 'historique_visibilite'];


}