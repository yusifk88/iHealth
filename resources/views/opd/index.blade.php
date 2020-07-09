<?php
use App\Http\Controllers\patientController;
?>
@extends('layouts.admin')

@section('content')


    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <p class="card-title">OPD Attendance</p>

                </div>
                <div class="card-body">
                    {{$attendance->links()}}
                    <table class="table table-hover table-striped">
                        <thead>
                        <tr>
                            <th>OPD#</th>
                            <th>Name</th>
                            <th>cc_code</th>
                            <th>Temperature</th>
                            <th>Date</th>
                            <th>Staff</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($attendance as $tt)

                            <tr>
                                <td>{{\App\Http\Controllers\patientController::get_patient($tt->patient_id)->opd_number}}</td>
                                <td>{{\App\Http\Controllers\patientController::get_patient($tt->patient_id)->surname}} {{\App\Http\Controllers\patientController::get_patient($tt->patient_id)->other_name}}</td>
                                <td>{{$tt->cc_code}}</td>
                                <td>{{$tt->temperature}}</td>
                                <td>{{$tt->entry_date}}</td>
                                <td>{{\App\Http\Controllers\staffController::get_staff($tt->user_id)->name}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{$attendance->links()}}

                </div>

            </div>

        </div>

    </div>



@endsection
