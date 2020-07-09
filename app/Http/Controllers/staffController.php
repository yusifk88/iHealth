<?php

namespace App\Http\Controllers;

use App\Staff;
use App\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class staffController extends Controller
{
    public  function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['staff_list']=Staff::orderBy('name','asc')->get();
        return view('staff.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['wards']=Ward::orderBy('name')->get();
        $data['roles']=Ward::orderBy('name')->get();


        return view('staff.create',$data);
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
            'name' => 'required',
            'type' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();


            $staff = new Staff($request->all());
                $staff->save();

                return redirect()->back()->with('success','Staff ('.$request->name.') was created successfully');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['staff'] = Staff::find($id);
        $data['ward'] = Ward::find($data['staff']->ward_id);
        return view('staff.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['wards']=Ward::orderBy('name')->get();
        $data['roles']=Ward::orderBy('name')->get();
        $data['staff'] = Staff::find($id);
        return view('staff.edit',$data);
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
            'type' => 'required',
             ])->validate();



        DB::statement("update staff set ward_id = '$request->ward_id',name='$request->name',type='$request->type' where id = '$id'");


        return redirect('/viewstaff/'.$id)->with('success','Staff ('.$request->name.') was updated successfully');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Staff::find($id)->delete();
        return redirect('/stafflist')->with('success','Staff deleted');
    }


    public function reset($id){

        $data['staff'] = Staff::find($id);

        return view('staff.resetpassword',$data);



    }


    public function savereset(Request $request, $id){
        Validator::make($request->all(), [

            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ])->validate();


        $passhash = Hash::make($request->password);
        DB::statement("update staff set password = '$passhash' where id = '$id' ");


        return redirect('/viewstaff/'.$id)->with('success','Password reset was successful');


    }


    public static function  get_staff($id){

        return Staff::find($id);

    }
}
