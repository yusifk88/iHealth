<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patient';

    protected $fillable =[
        'user_id','surname','other_name','dob','age','sex','marital_status','home_address',
        'phone_number','email','relative_name','relative_address','district','location','religion','occupation',
        'insurance_scheme','insurance_number','insurance_id','attendance_date','insured','nationality_id','opd_number'
    ];
}
