@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="row">
                <div class="col-md-4">
                    <div class="card border-bottom border-3 border-primary">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <i class="fa fa-users fa-3x text-primary"></i>
                                </div>
                                <div class="col-md-8 text-center text-primary">
                                    <h2>Staff</h2>
                                    <strong class="p-1 bg-primary-gradient text-light">{{$staff}}</strong><br>
                                    <a href="/stafflist" class="btn btn-primary btn-link">View</a>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                        <div class="col-md-4">
                            <div class="card border-bottom border-3 border-success">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <i class="fa fa-users fa-3x text-success"></i>
                                        </div>
                                        <div class="col-md-8 text-center text-success">
                                            <h2>Patients</h2>
                                            <strong class="p-1 bg-success-gradient text-light">{{$patients}}</strong> <br>
                                            <a href="/stafflist" class="btn btn-success btn-link">View</a>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>


                        <div class="col-md-4">
                            <div class="card border-bottom border-3 border-warning">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <i class="fa fa-address-card fa-3x text-warning"></i>
                                        </div>
                                        <div class="col-md-8 text-center text-warning">
                                            <h2>Attendance</h2>
                                            <strong class="p-1 bg-warning-gradient text-light">{{$opd}}</strong> <br>
                                            <a href="/stafflist" class="btn btn-warning btn-link">View</a>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

            </div>

            <div class="row">
                <div class="col-md-12">

                <div class="card">
                    <div class="card-header">
                        <h3>Activity statistics</h3>

                    </div>
                    <div class="card-body">

                        <div class="chart-container" style="min-height: 375px">
                            <canvas id="statisticsChart"></canvas>
                        </div>
                        <div id="myChartLegend"></div>


                    </div>

                </div>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <h2>Recent Attendance</h2>
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th>
                                Date
                            </th>
                            <th>
                                Name
                            </th>

                            <th>
                                OPD#
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($recent_attendance as $attendance)
                            <tr>
                                <td>{{$attendance->created_at}}</td>
                                <td>
                                    <a href="/patient/{{$attendance->patient->id}}" class="btn btn-link text-primary">
                                    {{$attendance->patient->surname}} {{$attendance->patient->other_name}}
                                    </a>
                                </td>
                                <td>
                                  <a href="/opd/{{$attendance->id}}" class="btn btn-link text-primary">
                                      {{$attendance->patient->opd_number}}
                                  </a>


                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>

        </div>


    </div>
</div>
@endsection
