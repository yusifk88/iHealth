@extends('layouts.admin')

@section('content')

    <div class="col-md-12 mx-auto">
        <div class="card">
            <div class="card-header">
                <p class="card-title">Staff List</p>

            </div>

            <div class="card-body">
                <div class="table-responsive">

                    <table class="table table-striped table-hover" id="staff_table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>E-Mail</th>
                                <th>Type</th>
                                <th>Ward</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($staff_list as $staff)
                            <tr>
                                <td><a href="/viewstaff/{{$staff->id}}" class="btn btn-primary btn-link">{{$staff->name}}</a></td>
                                <td>{{$staff->email}}</td>
                                <td>{{$staff->type}}</td>
                                <td><a class="btn btn-primary btn-link" href="viewward/{{$staff->ward_id}}">{{$staff->ward->name}}</a></td>
                                <td>
                                    <a href="/viewstaff/{{$staff->id}}" class="btn btn-primary btn-link">View</a>
                                    <a href="/editstaff/{{$staff->id}}" class="btn btn-primary btn-link">Edit</a></td>

                            </tr>

                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>


<script>


</script>


@endsection
