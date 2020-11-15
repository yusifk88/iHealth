<?php

namespace App\Http\Controllers;

use App\Nationality;
use App\OPD;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class patientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $patients = Patient::orderBy('surname','asc')->get();
        return response()->json($patients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        $exists = Patient::where('opd_number',$request->opd_number)->exists();
        if ($exists){
            return response('OPD number already exists',302);
        }

        $data = $request->all();
        $data['user_id'] = $request->user()->id;
        $patient = new Patient($data);
        $patient->save();
        return \response()->json($patient);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $patient = Patient::find($id);
        return response()->json($patient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {


    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {


        DB::statement("update patient set surname ='$request->surname',

                            other_name = '$request->other_name',dob='$request->dob',age='$request->age',sex='$request->sex',

                            marital_status='$request->marital_status',home_address='$request->home_address',postal_address='$request->postal_address', phone_number = '$request->phone_number',
                            email='$request->email',relative_name='$request->relative_name',relative_address='$request->relative_address',
                            district = '$request->district',location='$request->location', religion='$request->religion', insurance_scheme='$request->insurance_scheme',
                            insurance_number='$request->insurance_number',insurance_id='$request->insurance_id', attendance_date='$request->attendance_date',
                            insured='$request->insured',
                            nationality_id = '$request->nationality_id',occupation='$request->occupation' where id = '$id'");




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Patient::find($id)->delete();
    }

    public function nationailites(){

        $nationalities = Nationality::orderby('title','asc')->get();
        return response()->json($nationalities);
    }

    public function opd(){
        $opd_number = null;
        $max_id = Patient::get()->max('id');
        $max_id++;
        if($max_id < 10){
           $opd_number= '00000'.$max_id.'/'.Carbon::now()->year;

        }elseif ($max_id <100){
            $opd_number= '0000'.$max_id.'/'.Carbon::now()->year;


        }elseif($max_id <1000){
            $opd_number= '000'.$max_id.'/'.Carbon::now()->year;


        }elseif ($max_id <10000){
            $opd_number= '00'.$max_id.'/'.Carbon::now()->year;


        }elseif ($max_id < 100000){
            $opd_number= '00'.$max_id.'/'.Carbon::now()->year;


        }elseif($max_id<1000000){
            $opd_number= '0'.$max_id.'/'.Carbon::now()->year;


        }else{

            $opd_number= $max_id.'/'.Carbon::now()->year;

        }

        return response($opd_number);


}


    public function getbyopd($id){

        $opd = OPD::find($id);
        $patient=Patient::find($opd->patient_id);
        return response()->json($patient);

    }

    public function showopd($id){
        $opd = OPD::find($id);
        return response()->json($opd);
    }


}
