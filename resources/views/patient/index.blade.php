@extends('layouts.admin')

@section('content')


    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card">
                <div class="card-header">
                    <p class="card-title">Registered Patients</p>

                </div>
                <div class="card-body">
                    {{$patients->links()}}
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>OPD#</th>
                                <th>Name</th>
                                <th>DOB</th>
                                <th>Home Address</th>
                                <th>Phone Number</th>
                                <th>District</th>
                                <th>Date Registered</th>
                                <th>Insurance</th>
                            </tr>
                        </thead>
                        <tbody>

                        @foreach($patients as $patient)

                            <tr>
                                <td>{{$patient->opd_number}}</td>
                                <td>{{$patient->surname}} {{$patient->other_name}}</td>
                                <td>{{$patient->dob}}</td>
                                <td>{{$patient->home_address}}</td>
                                <td>{{$patient->phone_number}}</td>
                                <td>{{$patient->district}}</td>
                                <td>{{$patient->attendance_date}}</td>
                                <td>

                                    @if($patient->insured)
                                    <span class="bg-success-gradient p-2 text-light">Insured</span>
                                    @else
                                        <span class="bg-danger-gradient p-2 text-light">Not Insured</span>

                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$patients->links()}}

                </div>

            </div>

        </div>

    </div>



@endsection
