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
        // Tâche 1 : Exécuter chaque dimanche à minuit
        $schedule->command('app:generate-paiementhebdo')->weekly()->sundays()->at('00:00');

        // Tâche 2 : Exécuter à la fin de chaque mois
        $schedule->command('app:generate-paiementmensuel')->monthly();
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
