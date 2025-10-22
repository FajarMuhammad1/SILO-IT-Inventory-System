<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule)
    {
        // Jadwal task bisa dikosongkan dulu
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands'); // commands custom
        require base_path('routes/console.php'); // commands routes
    }
}
