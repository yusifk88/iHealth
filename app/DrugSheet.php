<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DrugSheet extends Model
{
    protected $table = 'drugsheet';
    protected $fillable = ['staff_id','attendance_id','drug_name','remark'];
}
