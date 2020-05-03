<?php

namespace App\Providers;

use App\Staff;
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

    }
}
