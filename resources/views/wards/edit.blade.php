@extends('layouts.admin')


@section('content')


    <div class="col-md-6 mx-auto">
        <div class="card">
            <div class="card-header">
                <p class="card-title">Edit A  New Ward</p>

            </div>



            <div class="card-body">

                <form action="/updateward/{{$ward->id}}" method="post">
                    {{csrf_field()}}
                    <label for="name" class="form-control-label">Name<sup class="text-danger">*</sup></label>
                    <input type="text" name="name" value="{{$ward->name}}" id="name" class="form-control" required>


                    <label for="description" class="form-control-label">Description<sup class="text-danger">*</sup></label>

                    <textarea class="form-control" name="description" id="description">{{$ward->description}}</textarea>
                    <button type="submit" class="btn btn-primary btn-block mt-3">Update</button>

                    <a href="/wards" class="btn btn-primary btn-block btn-link mt-3">View All Wards</a>

                </form>

            </div>


        </div>
    </div>




@endsection
