<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class usersController extends Controller
{
    public function getuser(Request  $request){
        return $request->user();
    }
}
