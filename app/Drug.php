<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $table = 'drugs';
    protected $fillable = [
        'user_id','description','code','type','price','quantity'
    ];
}
