<?php

namespace App\Console;

use App\Models\Post;
use Carbon\Carbon;
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
        $schedule->call(function () {
            // Update the status of posts created exactly 10 minutes ago
            $tenMinutesAgo = Carbon::now()->subMinutes(1);
           Post::where('status', Post::ON_HOLD)
                ->where('created_at', '<=', $tenMinutesAgo)
                ->update(['status' => Post::AVAILABLE]);
        })->everyMinute();;
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
