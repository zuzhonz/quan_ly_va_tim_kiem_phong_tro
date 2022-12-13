<?php

namespace App\Console;

use App\Console\Commands\cronEmail;
use App\Models\PlanHistory;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        cronEmail::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('motel:cron')->withoutOverlapping()->everyMinute();

        $schedule->command('command:email')->daily();

        $schedule->call(function () {
            $plan_history = PlanHistory::where('status', 1)->get();
            foreach ($plan_history as $plan) {
                if ($plan->day - 1 > 0) {
                    PlanHistory::where('id', $plan->id)->update(['day' => $plan->day - 1]);
                } else {
                    PlanHistory::where('id', $plan->id)->update(['status' => 5]);
                }
            }
        })->daily();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
