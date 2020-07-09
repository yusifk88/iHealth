<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NuresesNote extends Model
{
    protected $table = 'nursesnotes';

    protected $fillable = [
        'staff_id','attendance_id','note'
    ];

}
