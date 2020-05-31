<?php

namespace App\Http\Controllers;

use App\OPD;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OPDController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $opd = OPD::all();

        return response()->json($opd);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $exists = OPD::where('patient_id',$request->patient_id)->where('entry_date',$request->entry_date)->exists();
        if(!$exists){

            $data = $request->all();

            $data['user_id'] = $request->user()->id;

            $opd = new OPD($data);

            $opd->save();
            return response()->json($opd);
        }else{
            return response('This person was already admitted today, you can not admit a person more than ones in a day',302);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        DB::statement("update opd set temperature = '$request->temperature',temperature_remarks='$request->temperature_remarks',bp='$request->bp',bp_remarks='$request->bp_remarks',height='$request->height',weight='$request->weight',weight_remarks='$request->weight_remarks',respiration='$request->respiration',respiration_remarks='$request->respiration_remarks',pulse='$request->pulse',pulse_remarks='$request->pulse_remarks' where id = '$id' ");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
