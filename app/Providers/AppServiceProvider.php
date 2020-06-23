<?php

namespace App\Providers;

use App\Consultance;
use App\Drug;
use App\DrugSheet;
use App\Lab;
use App\NuresesNote;
use App\OPD;
use App\Patient;
use App\Prescrition;
use App\Sale;
use App\TemperatuerSheet;
use App\User;
use App\Ward;
use Illuminate\Support\ServiceProvider;
use function foo\func;

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

    Prescrition::retrieved(function ($p){

        $p->drug = Drug::find($p->drug_id);

    });
    Consultance::retrieved(function ($c){
        $c->prescription = Prescrition::where('consulting_id',$c->id)->get();
        $c->ward = Ward::find($c->ward_id);

    });
    Sale::retrieved(function ($sale){
        $sale->drug = Drug::find($sale->drug_id);
        $opd = OPD::find($sale->opd_id);
        $sale->patient = Patient::find($opd->patient_id);
    });

    TemperatuerSheet::retrieved(function ($tem){
        $tem->nurse = User::find($tem->staff_id);

    });
    NuresesNote::retrieved(function ($note){

        $note->nurse = User::find($note->staff_id);

    });
    DrugSheet::retrieved(function ($drug){

        $drug->nurse = User::find($drug->staff_id);
    });


    }


}
