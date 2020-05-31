<?php

namespace App\Http\Controllers;

use App\Drug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class drugsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drugs = Drug::orderBy('description','asc')->get();

        return response()->json($drugs);

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

        $code_exist = Drug::where('code',$request->code)->exists();
        if ($code_exist) {

            return response('This drug code already exist, Drugs cannot have the same code',302);
        }else{
            $data = $request->all();
            $data['user_id'] = $request->user()->id;
            $drug = new Drug($data);
            $drug->save();
            dd($drug);
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

        $code_exist = Drug::where('code',$request->code)->where('id','<>',$id)->exists();
        if ($code_exist) {
            return response('This drug code already exist, Drugs cannot have the same code',302);


        }else{

            DB::statement("update drugs set code='$request->code',description='$request->description',type='$request->type',price='$request->price',quantity='$request->quantity' where id='$id'");
        }
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
