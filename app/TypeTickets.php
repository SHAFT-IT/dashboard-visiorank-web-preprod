<?php
/**
 * Created by PhpStorm.
 * User: Tahiry
 * Date: 05/06/2018
 * Time: 10:24
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class TypeTickets extends Model
{
    public $timestamps = array();
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type_id', 'libelle'];
}