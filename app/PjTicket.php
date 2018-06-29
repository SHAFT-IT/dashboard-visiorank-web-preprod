<?php
/**
 * Created by PhpStorm.
 * User: Tahiry
 * Date: 07/06/2018
 * Time: 10:01
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class PjTicket extends Model {
        public $primaryKey = "pj_id";

    public $timestamps = array();
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['pj_ticket', 'pj_file', 'pj_date', 'pj_visibilite'];


}