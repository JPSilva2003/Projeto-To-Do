<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MailtrapService
{
    public static function enviarEmail($para, $assunto, $conteudo)
    {
        $response = Http::withToken(env('MAILTRAP_API_TOKEN'))
            ->post('https://send.api.mailtrap.io/api/send', [
                'from' => [
                    'email' => env('MAIL_FROM_ADDRESS'),
                    'name'  => env('MAIL_FROM_NAME', 'ToDo App'),
                ],
                'to' => [
                    ['email' => $para, 'name' => 'Destinatário']
                ],
                'subject' => $assunto,
                'text' => $conteudo,
            ]);

        return $response->successful();
    }
}
