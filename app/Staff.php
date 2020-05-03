<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';
    protected $fillable = ['name','ward_id','type','email','password'];
}
