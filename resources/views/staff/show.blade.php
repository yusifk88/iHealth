@extends('layouts.admin')


@section('content')


    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header border-bottom border-primary">
                <p class="card-title">
                <h2>{{$staff->name}}</h2>
                <a href="/stafflist" class="btn btn-primary btn-link btn-sm">All Staff</a>
                <a href="/editstaff/{{$staff->id}}" class="btn btn-primary btn-link btn-sm">Edit</a>
                <a href="/createstaff" class="btn btn-primary btn-link btn-sm">New Staff</a>
                <a href="/resetpassword/{{$staff->id}}" class="btn btn-primary btn-link btn-sm">Reset {{$staff->name}}'s Password</a>
                </p>

            </div>
            <div class="card-body">
                <p>
                    {{$staff->name}}<br>
                    <small class="text-muted">Name</small>
                </p>

                <p>
                    {{$staff->email}}<br>
                    <small class="text-muted">E-Mail Address</small>
                </p>

                <p>
                    {{$staff->type}}<br>
                    <small class="text-muted">Staff type/Role</small>
                </p>

                <p>

                    @if($ward)

                    <a href="/viewward/{{$ward->id}}">{{$ward->name}}</a>
                        @else
                        <em>Not Assigned</em>

                        @endif
                    <br>

                    <small class="text-muted">Ward</small>
                </p>


            </div>

        </div>






        <div class="modal fade" id="deleteModal" role="dialog" aria-hidden="true" tabindex="1">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header no-bd">
                        Confirm Delete
                    </div>
                    <div class="modal-body">
                        <h3>Are you sure you want to delete this staff?</h3>

                    </div>
                    <div class="modal-footer">
                        <a href="/deletestaff/{{$staff->id}}" class="btn btn-link btn-danger">Delete</a>
                        <button data-dismiss="modal" class="btn btn-link btn-primary">Cancel</button>
                    </div>
                </div>
            </div>

        </div>

    </div>


@endsection
