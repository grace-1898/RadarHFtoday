<?php

namespace App\Console;

use dataradar;
use App\data_radar;
// use Illuminate\Support\Facades\dataradar;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\HapusData::class,
// 'App\Console\Commands\HapusData', //sama aja kayak atasnya, well function

        // 'App\Console\Commands\TestCron',
        
        // HapusData::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        dataradar::table('data_radar')->where('created_at', '<', Carbon::now()->subDays(5))
        ->delete();
        // $schedule->command('inspire')
        //          ->hourly;
        $schedule->command('hapus:data')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
