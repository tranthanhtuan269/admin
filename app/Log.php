<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'logs';
    public $timestamps = false;

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'message', 'created_at'];

    
}
