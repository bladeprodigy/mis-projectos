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
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
<<<<<<< HEAD
    protected $routeMiddleware = [
        // Inne middleware...
        'auth.custom' => \App\Http\Middleware\Authenticate::class,
    ];
=======
>>>>>>> parent of 6a5f8084 (Delete Backend directory in main zeby nie bylo konfliktow)
}
