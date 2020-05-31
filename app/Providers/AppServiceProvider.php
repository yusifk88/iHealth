<?php

namespace App\Providers;

use App\Consultance;
use App\Drug;
use App\OPD;
use App\Patient;
use App\Prescrition;
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
            $opd->dispensary_status = false;
            $opd->lab_status = false;
        });

    Prescrition::retrieved(function ($p){

        $p->drug = Drug::find($p->drug_id);

    });
    Consultance::retrieved(function ($c){
        $c->prescription = Prescrition::where('consulting_id',$c->id)->get();
    });


    }


}
