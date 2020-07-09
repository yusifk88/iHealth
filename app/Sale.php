<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $fillable = ['user_id','opd_id','drug_id','quantity','unit_price','amount'];
}
