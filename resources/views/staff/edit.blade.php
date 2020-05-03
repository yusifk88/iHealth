@extends('layouts.admin')

@section('content')



    <div class="col-md-8 mx-auto">
        <div class="card">
            <div class="card-header">
                <p class="card-title">Update Staff</p>
            </div>
            <div class="card-body">


                <form method="post" action="/updatestaff/{{$staff->id}}">
                    {{csrf_field()}}
                    <p> <small class="text-muted">Personal Info.</small></p>

                    <label class="form-control-label" for="name">Staff Name<sup class="text-danger">*</sup></label>
                    <input autofocus type="text" name="name" id="name" value="{{$staff->name}}" required class="form-control">


                    <p> <small class="text-muted">Access Info.</small></p>

                    <label class="form-control-label" for="type">Staff Type <sup class="text-danger">*</sup></label>
                    <select class="form-control" name="type" id="type">
                        <option <?=$staff->type == 'nurse' ? 'selected':''?> value="nurse">Nurse</option>
                        <option <?=$staff->type == 'records' ? 'selected':''?> value="records">Records Officer</option>
                        <option <?=$staff->type == 'opd' ? 'selected':''?> value="opd">OPD Attendant</option>
                        <option <?=$staff->type == 'dispensing' ? 'selected':''?> value="dispensing">Dispensing Officer</option>
                        <option <?=$staff->type == 'consulting' ? 'selected':''?> value="consulting">Consulting Officer</option>
                    </select>


                    <label class="form-control-label mt-4" for="ward">Ward</label>
                    <select class="form-control" name="ward_id" id="ward">
                        <option value="">None</option>
                        @foreach($wards as $ward)
                            @if($staff->ward_id === $ward->id)
                            <option selected value="{{$ward->id}}">{{$ward->name}}</option>

                                @else
                                <option value="{{$ward->id}}">{{$ward->name}}</option>

                            @endif
                        @endforeach
                    </select>


                    <p> <small class="text-muted">Account/Login Info.</small></p>

                    <label class="form-control-label" for="email">E-Mail Address<sup class="text-danger">*</sup></label>
                    <input type="email" name="email" value="{{$staff->email}}" disabled id="email" required class="form-control">


                    <p class="mt-3">
                        <button type="submit" class="btn btn-primary btn-block">Update</button>
                        <a href="/stafflist" class="btn btn-primary btn-block btn-link">View All Staff</a>
                    </p>

                </form>

            </div>

        </div>


    </div>




@endsection
