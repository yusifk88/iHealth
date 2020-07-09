<?php

namespace App\Http\Controllers;

use App\OPD;
use App\Patient;
use App\Staff;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $data['staff'] = Staff::all()->count();
        $data['patients'] = Patient::all()->count();
        $data['opd'] = OPD::all()->count();

        $data['attend_1'] = OPD::whereMonth('created_at','=',1)->count();
        $data['attend_2'] = OPD::whereMonth('created_at','=',2)->count();
        $data['attend_3'] = OPD::whereMonth('created_at','=',3)->count();
        $data['attend_4'] = OPD::whereMonth('created_at','=',4)->count();
        $data['attend_5'] = OPD::whereMonth('created_at','=',5)->count();
        $data['attend_6'] = OPD::whereMonth('created_at','=',6)->count();
        $data['attend_7'] = OPD::whereMonth('created_at','=',7)->count();
        $data['attend_8'] = OPD::whereMonth('created_at','=',8)->count();
        $data['attend_9'] = OPD::whereMonth('created_at','=',9)->count();
        $data['attend_10'] = OPD::whereMonth('created_at','=',10)->count();
        $data['attend_11'] = OPD::whereMonth('created_at','=',11)->count();
        $data['attend_12'] = OPD::whereMonth('created_at','=',12)->count();



        $data['patient_1'] = Patient::whereMonth('created_at','=',1)->count();
        $data['patient_2'] = Patient::whereMonth('created_at','=',2)->count();
        $data['patient_3'] = Patient::whereMonth('created_at','=',3)->count();
        $data['patient_4'] = Patient::whereMonth('created_at','=',4)->count();
        $data['patient_5'] = Patient::whereMonth('created_at','=',5)->count();
        $data['patient_6'] = Patient::whereMonth('created_at','=',6)->count();
        $data['patient_7'] = Patient::whereMonth('created_at','=',7)->count();
        $data['patient_8'] = Patient::whereMonth('created_at','=',8)->count();
        $data['patient_9'] = Patient::whereMonth('created_at','=',9)->count();
        $data['patient_10'] = Patient::whereMonth('created_at','=',10)->count();
        $data['patient_11'] = Patient::whereMonth('created_at','=',11)->count();
        $data['patient_12'] = Patient::whereMonth('created_at','=',12)->count();

        $data['recent_attendance'] = OPD::orderBy('created_at','desc')->limit(10)->get();

        return view('home',$data);

    }
}
