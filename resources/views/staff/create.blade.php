@extends('layouts.admin')

@section('content')

<div class="col-md-8 mx-auto">
    <div class="card">
        <div class="card-header">
            <p class="card-title">Create a Staff</p>
        </div>
        <div class="card-body">
            <div class="alert alert-warning">
                <p>
                    Make sure to select a Ward when creating a Nurse
                </p>

            </div>

            <form method="post" action="/savestaff">
                {{csrf_field()}}
               <p> <small class="text-muted">Personal Info.</small></p>

                <label class="form-control-label" for="name">Staff Name<sup class="text-danger">*</sup></label>
                <input autofocus type="text" name="name" id="name" required class="form-control">


               <p> <small class="text-muted">Access Info.</small></p>

                <label class="form-control-label" for="type">Staff Type <sup class="text-danger">*</sup></label>
                <select class="form-control" name="type" id="type">
                    <option value="nurse">Nurse</option>
                    <option value="records">Records Officer</option>
                    <option value="opd">OPD Attendant</option>
                    <option value="dispensing">Dispensing Officer</option>
                    <option value="consulting">Consulting Officer</option>
                </select>


                <label class="form-control-label mt-4" for="ward">Ward</label>
                <select class="form-control" name="ward_id" id="ward">
                    <option value="">None</option>
                   @foreach($wards as $ward)

                       <option value="{{$ward->id}}">{{$ward->name}}</option>
                       @endforeach
                </select>


               <p> <small class="text-muted">Account/Login Info.</small></p>

                <label class="form-control-label" for="email">E-Mail Address<sup class="text-danger">*</sup></label>
                <input type="email" name="email" id="email" required class="form-control">


                <label class="form-control-label" for="password">Password<sup class="text-danger">*</sup></label>
                <input type="password" name="password" id="password" required class="form-control">

                <label class="form-control-label" for="password_confirmation">Confirm Password<sup class="text-danger">*</sup></label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="form-control">


                <p class="mt-3">
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                    <a href="/stafflist" class="btn btn-primary btn-block btn-link">View All Staff</a>
                </p>

            </form>

        </div>

    </div>


</div>









@endsection
