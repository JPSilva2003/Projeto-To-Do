<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TarefasPendentesMail extends Mailable
{
    use Queueable, SerializesModels;

    public $tarefas;

    public function __construct($tarefas)
    {
        $this->tarefas = $tarefas;
    }

    public function build()
    {
        return $this->subject('Tarefas pendentes para hoje')
            ->view('emails.tarefas_pendentes');
    }
}
