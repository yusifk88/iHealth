<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescrition extends Model
{

    protected $table='prescription';
    protected $fillable =['user_id','opd_id','consulting_id','drug_id','quantity','dosage','dispensed','remark'];
}
