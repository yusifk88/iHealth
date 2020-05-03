<?php

namespace App\Http\Controllers;

use App\Staff;
use App\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class wardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data['wards'] = Ward::all();

        return view('wards.index',$data);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('wards.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        Validator::make($request->all(), [
            'name' => 'required|unique:wards',
        ])->validate();

        $ward = new Ward($request->all());
        $ward->save();
        return redirect()->back()->with('success','Ward Created');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['ward'] = Ward::find($id);
        $data['staff'] = Staff::where('ward_id',$id)->get();
        return view('wards.show',$data);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $data['ward'] = Ward::find($id);
        return view('wards.edit',$data);



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
        Validator::make($request->all(), [
            'name' => 'required',
        ])->validate();

        Ward::find($id)->update($request->all());

        return redirect('/viewward/'.$id)->with('success','Ward updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Ward::find($id)->delete();

        return redirect('/wards')->with('success','Ward Deleted');
    }
}
