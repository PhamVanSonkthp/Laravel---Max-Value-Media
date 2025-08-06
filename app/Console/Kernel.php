<?php

namespace App\Console;

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

    protected $commands = [

    ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        $schedule->command('email:job_notification')
            ->everyMinute();

        $schedule->command('email:job_email')
            ->everyMinute();

        $schedule->command('schedule:bank_cash_in')
            ->everyMinute();

        if (env('APP_ENV') == "local") {
            $schedule->command('cache:clear-expired')->everyMinute();
            $schedule->command('schedule:sitemap')->everyMinute();
            $schedule->command('backup:run')->everyMinute();
        } else {
            $schedule->command('cache:clear-expired')
                ->timezone('Asia/Ho_Chi_Minh')
                ->dailyAt('00:00');

            $schedule->command('schedule:sitemap')
                ->timezone('Asia/Ho_Chi_Minh')
                ->dailyAt('00:00');

            $schedule->command('backup:run')
                ->timezone('Asia/Ho_Chi_Minh')
                ->dailyAt('00:00');
        }


        // duplicate with cores of servers
//        $schedule->command('queue:work --timeout=60')
//            ->everyMinute()
//            ->withoutOverlapping()
//            ->sendOutputTo(storage_path() . '/logs/queue-jobs.log');
        //
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
