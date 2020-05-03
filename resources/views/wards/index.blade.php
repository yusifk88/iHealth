
@extends('layouts.admin')

@section('content')


    <div class="col-md-10 mx-auto">
        <div class="card">
            <div class="card-header">
                <p class="card-title w-100">
                    Wards
                    <a href="/createward" class="btn btn-primary text-light mr-auto align-self-end">New Ward <i class="fa fa-plus"></i></a>

                </p>

            </div>
            <div class="card-body">

                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Created On</th>
                            <th>Action</th>
                        </tr>

                    </thead>
                    <tbody>
                    @foreach($wards as $ward)
                    <tr>
                        <td>{{$ward->name}}</td>
                        <td>{{$ward->descrition}}</td>
                        <td>{{$ward->created_at}}</td>
                        <td>
                            <a href="/editward/{{$ward->id}}" class="btn btn-link btn-primary">Edit</a>
                            <a href="/viewward/{{$ward->id}}" class="btn btn-link btn-primary">View</a>
                        </td>

                    </tr>
                    @endforeach



                    </tbody>



                </table>

            </div>

        </div>

    </div>




@endsection
