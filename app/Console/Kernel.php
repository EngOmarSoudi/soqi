<?php

namespace App\Console;

use App\Console\Commands\expiration;
use App\Console\Commands\Notify;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('user:expire')->everyMinute();
        $schedule->command('notify:email')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
//        $this->load(__DIR__.'/Commands/expiration.php');

        require base_path('routes/console.php');
//        require expiration::class;


    }
    protected $commands =[
      expiration::class,
        Notify::class
    ];
}
