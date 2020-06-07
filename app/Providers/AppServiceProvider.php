<?php

namespace App\Providers;

use App\Consultance;
use App\Drug;
use App\Lab;
use App\OPD;
use App\Patient;
use App\Prescrition;
use App\Sale;
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

        });

    Prescrition::retrieved(function ($p){

        $p->drug = Drug::find($p->drug_id);

    });
    Consultance::retrieved(function ($c){
        $c->prescription = Prescrition::where('consulting_id',$c->id)->get();
        $c->ward = Ward::find($c->ward_id);

    });


    }


}
