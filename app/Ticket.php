<?php
/**
 * Created by PhpStorm.
 * User: Tahiry
 * Date: 01/06/2018
 * Time: 15:50
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    public $primaryKey = 'ticket_id';

    public $timestamps = array();
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'created_by', 'ticket_priorite_id', 'ticket_last_status','titre', 'description', 'date_creation', 'date_modification', 'visibilite'];

}