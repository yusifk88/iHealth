<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultance extends Model
{
    protected $table = 'consultance';
    protected $fillable=['user_id','patient_id','opd_id','complain','complain_history','drug_history','family_history','questions','medical_history','psychological_history',
                        'gynecological_history','system_review','diagnosis','detained','ward_id','other_drugs'];
}
