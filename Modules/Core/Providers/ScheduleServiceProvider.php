<?php

namespace Modules\Core\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Stringable;

class ScheduleServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->exec('composer dump-autoload')
                ->after(function (Stringable $output) {
                    Log::info("Dump autoload executed at ". time());
                })
               // ->dailyAt('00:01')
               //->everyTwoMinutes()
                ->runInBackground();
        });
    }

    public function register()
    {

    }

}
