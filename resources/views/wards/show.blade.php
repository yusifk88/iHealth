@extends('layouts.admin')


@section('content')


    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header border-bottom border-primary">
                <p class="card-title">
                    <h2>{{$ward->name}}</h2>
                <a href="/wards" class="btn btn-primary btn-link btn-sm">All Wards</a>
                <a href="/editward/{{$ward->id}}" class="btn btn-primary btn-link btn-sm">Edit</a>
                <a href="/createward" class="btn btn-primary btn-link btn-sm">New Ward</a>
                <button data-toggle="modal" data-target="#deleteModal" class="btn btn-danger btn-link btn-sm">Delete</button>
                </p>

            </div>
            <div class="card-body">
                <small class="text-muted">About {{$ward->name}}</small>
                <p>
                    {{$ward->description}}
                </p>
            </div>

        </div>


        <div class="card">
            <div class="card-header border-bottom border-primary">
                <p class="card-title">
                <h2>Staff Assigned to {{$ward->name}}</h2>

                </p>

            </div>
            <div class="card-body">

                <div class="list-group list-group-flush">
                    @foreach($staff as $s)

                        <div class="list-group-item">
                            <a href="/viewstaff/{{$s->id}}" class="btn btn-primary btn-link">{{$s->name}}</a>
                        </div>
                        @endforeach

                </div>

            </div>

        </div>


        <div class="modal fade" id="deleteModal" role="dialog" aria-hidden="true" tabindex="1">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header no-bd">
                        Confirm Delete
                    </div>
                    <div class="modal-body">
                        <h3>Are you sure you want to delete this ward?</h3>

                    </div>
                    <div class="modal-footer">
                        <a href="/deleteward/{{$ward->id}}" class="btn btn-link btn-danger">Delete</a>
                        <button data-dismiss="modal" class="btn btn-link btn-primary">Cancel</button>
                    </div>
                </div>
            </div>

        </div>

    </div>


@endsection
