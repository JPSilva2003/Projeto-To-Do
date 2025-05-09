<?php


namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Regista os comandos Artisan da aplicação.
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');

    }
    protected $commands = [
        Commands\EnviarTarefasPendentes::class,
    ];
    /**
     * Define o agendamento de tarefas da aplicação.
     */
    protected function schedule(Schedule $schedule)
    {
        // Envia tarefas pendentes todos os dias às 08:00
        $schedule->command('tarefas:enviar-pendentes')->dailyAt('08:00');
    }
}
