<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Tarefa;
use Illuminate\Support\Facades\Mail;

class EnviarTarefasPendentes extends Command
{
    protected $signature = 'tarefas:enviar-pendentes';
    protected $description = 'Envia um email com as tarefas pendentes para hoje';

    public function handle()
    {
        $tarefasPendentes = Tarefa::where('estado', 'pendente')
            ->whereDate('data_vencimento', today())
            ->get();

        if ($tarefasPendentes->isEmpty()) {
            $this->info('Nenhuma tarefa pendente para hoje.');
            return;
        }

        $email = config('mail.to.address', 'fallback@email.com');

        try {
            Mail::send('emails.tarefas_pendentes', ['tarefas' => $tarefasPendentes], function ($message) use ($email) {
                $message->to($email)->subject('📅 Tarefas Pendentes para Hoje');
            });

            $this->info('Email enviado com sucesso!');
        } catch (\Throwable $e) {
            $this->error('Falha ao enviar email: ' . $e->getMessage());
        }
    }
}
