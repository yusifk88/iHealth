<?php

namespace App\Http\Controllers;

use App\Consultance;
use App\OPD;
use App\Prescrition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class consultanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $drugs = json_decode($request->selected_drugs,true);



            $opd = OPD::find($request->opd_id);
            $data=$request->all();
            $data['user_id']=$request->user()->id;
            $data['patient_id']=$opd->patient_id;

            $consult = new Consultance($data);
            $consult->save();

            $this->save_drugs($request,$drugs,$consult->id);

            return response()->json($consult);


    }



    public function save_drugs(Request $request,$drugs,$consult_id){
        foreach ($drugs as $drug)
        {
            $prescription = new Prescrition([
                'user_id'=>$request->user()->id,
                'opd_id'=>$request->opd_id,
                'consulting_id'=>$consult_id,
                'drug_id'=>$drug['drug_id'],
                'quantity'=>$drug['quantity'],
                'dosage'=>$drug['dosage'],
                'dispensed'=>0,
                'remark'=>''
            ]);
            $prescription->save();
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


        Prescrition::where('consulting_id',$id)->delete();
        DB::statement("update consultance set complain = '$request->complain',complain_history='$request->complain_history',drug_history='$request->drug_history',family_history='$request->family_history',questions='$request->questions',medical_history='$request->medical_history',psychological_history='$request->psychological_history',gynecological_history='$request->gynecological_history',system_review='$request->system_review',diagnosis='$request->diagnosis',detained='$request->detained',ward_id='$request->ward_id' where id ='$id'");


                $drugs = $request->selected_drugs;
          $this->save_drugs($request,json_decode($drugs,true),$id);


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
