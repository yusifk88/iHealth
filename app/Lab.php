<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lab extends Model
{
    protected $table='lab';
    protected $fillable=['user_id','opd_id','tests','results'];

}
