<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('schedule:ping', ['--timing' => 15])->everyFifteenSeconds();
        $schedule->command('schedule:ping', ['--timing' => 30])->everyThirtySeconds();
        $schedule->command('schedule:ping', ['--timing' => 60])->everyMinute();
        $schedule->command('schedule:ping', ['--timing' => 120])->everyTwoMinutes();
        $schedule->command('schedule:ping', ['--timing' => 300])->everyFiveMinutes();
        $schedule->command('schedule:ping', ['--timing' => 600])->everyTenMinutes();
        $schedule->command('schedule:ping', ['--timing' => 900])->everyFifteenMinutes();
        $schedule->command('schedule:ping', ['--timing' => 1800])->everyThirtyMinutes();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
