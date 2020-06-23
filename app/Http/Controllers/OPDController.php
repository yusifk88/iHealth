<?php

namespace App\Http\Controllers;

use App\Consultance;
use App\DrugSheet;
use App\Lab;
use App\NuresesNote;
use App\OPD;
use App\TemperatuerSheet;
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


    public function savelab(Request $request){

        $data = $request->all();
        $data['user_id'] = $request->user()->id;

        $lab = new Lab($data);
        $lab->save();
    }

    public function changelab(Request $request, $id){

        DB::statement("update lab set tests='$request->tests',results='$request->results' where id = '$id'");


    }


    public function detention(){

        $list = OPD::whereIn('id',Consultance::select('opd_id')->where('detained',1))->get();

            return response()->json($list);
    }


    public function savetemp(Request $request){
        $temp = new TemperatuerSheet([
            'temperature'=>$request->temperatiure,
            'remark'=>$request->remark,
            'time'=>$request->time,
            'staff_id'=>$request->user()->id,
            'attendance_id'=>$request->attendance_id
        ]);
        $temp->save();
        return response()->json($temp);

    }


    public function templist($id){

        $temp = TemperatuerSheet::where('attendance_id',$id)

                                ->orderBy('created_at','desc')
                                ->get();

        return response()->json($temp);

    }

    public function gettempgraph($id){

        $graph = [];
        $dates = DB::select("select distinct(created_at) from temperaturesheets where attendance_id = '$id'");
        foreach ($dates as $date) {
            $date->temprature = DB::select("select temperature from temperaturesheets where attendance_id = '$id' and created_at='$date->created_at'")[0]->temperature;
           array_push($graph,$date);

        }
        return response()->json($graph);



    }


    public function deletetemp($id){

        TemperatuerSheet::find($id)->delete();

    }

    public function savenursesnote(Request $request){


        $note = new NuresesNote([
            'staff_id'=>$request->user()->id,
            'note'=>$request->note,
            'attendance_id'=>$request->attendance_id
        ]);
        $note->save();

    }

    public function getnursesnote($id){

        $notes = NuresesNote::where('attendance_id',$id)->orderBy('created_at','desc')->get();
        return response()->json($notes);

    }

    public function deletenursesnote($id){

        NuresesNote::find($id)->delete();

    }

    public function savedrugsheet(Request $request){

            $drugsheet = new DrugSheet([
                'staff_id'=>$request->user()->id,
                'attendance_id'=>$request->attendance_id,
                'drug_name'=>$request->drug_name,
                'remark'=>$request->remark
            ]);

            $drugsheet->save();
    }

    public function drugsheet($id){
        $drugs = DrugSheet::where('attendance_id',$id)->orderBy('created_at','desc')->get();
        return response()->json($drugs);
    }

    public function deletedrugshet($id){
        DrugSheet::find($id)->delete();
    }

    public function patientattendance($id){

       $attendance =  OPD::where('patient_id',$id)->orderBy('created_at','desc')->get();

       return response()->json($attendance);


    }

}
