<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OPD extends Model
{
    protected $table = 'opd';
    protected $fillable = [
        'user_id','patient_id','temperature','bp','height','weight','pulse','respiration','cc_code',
        'temperature_remarks','bp_remarks','height_remarks','pulse_remarks','respiration_remarks','entry_date'
    ];

}
