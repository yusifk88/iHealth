<?php

namespace App\Providers;

use App\Consultance;
use App\Lab;
use App\NuresesNote;
use App\OPD;
use App\Patient;
use App\Prescrition;
use App\Sale;
use App\Staff;
use App\TemperatuerSheet;
use App\Ward;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {


        Staff::creating(function ($staff){
            $staff->password = Hash::make($staff->password);


        });

        Staff::retrieved(function ($staff){
            $staff->ward = Ward::find($staff->ward_id);


        });

        OPD::retrieved(function($opd){
            $opd->patient = Patient::find($opd->patient_id);
            $opd->consulting = Consultance::where('opd_id',$opd->id)->get()->first();
            $opd->consulting_status = Consultance::where('opd_id',$opd->id)->exists();
            $opd->dispensary_status = Prescrition::where('opd_id',$opd->id)->exists();
            $opd->sale_status = Sale::where('opd_id',$opd->id)->exists();
            $opd->dispensary = Prescrition::where('opd_id',$opd->id);
            $opd->lab_status = Lab::where('opd_id',$opd->id)->exists();
            $opd->lab = Lab::where('opd_id',$opd->id)->first();
            $opd->temperatuersheets = TemperatuerSheet::where('attendance_id',$opd->id)->get();
            $opd->nursesnotes = NuresesNote::where('attendance_id',$opd->id)->get();

        });

    }
}
