<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemperatuerSheet extends Model
{
    protected $table='temperaturesheets';
    protected $fillable=[
        'temperature','remark','time','staff_id','attendance_id'
    ];
}
