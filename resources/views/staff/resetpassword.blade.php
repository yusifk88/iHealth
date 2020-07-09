@extends('layouts.admin')

@section('content')

<div class="col-md-6 mx-auto">
    <div class="card">
        <div class="card-header">
            <p>Reset {{$staff->name}}'s Password</p>

        </div>

        <div class="card-body">
            <form action="/savereset/{{$staff->id}}" method="post">

                {{csrf_field()}}
                <label class="form-control-label" for="password">New Password <sup class="text-danger">*</sup></label>
                <input required type="password" class="form-control" name="password" id="password">

                <label  class="form-control-label" for="password_confirmation">Confirm Password <sup class="text-danger">*</sup></label>
                <input required type="password" class="form-control" name="password_confirmation" id="password_confirmation">

                <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                <a href="/viewstaff/{{$staff->id}}" class="btn btn-primary btn-block btn-link">Back to {{$staff->name}}'s Profile</a>
            </form>

        </div>

    </div>

</div>


@endsection
