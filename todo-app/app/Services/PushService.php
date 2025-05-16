<?php

namespace App\Services;

use Minishlink\WebPush\WebPush;
use Minishlink\WebPush\Subscription;
use App\Models\NotificationTrigger;

class PushService
{
    public static function sendToTrigger($triggerName, $title, $body, $url = '/')
    {
        $trigger = NotificationTrigger::with('subscriptions.pushSubscription')
            ->where('name', $triggerName)
            ->first();

        if (!$trigger) {
            \Log::warning("🚫 Trigger '{$triggerName}' não encontrado.");
            return;
        }

        $count = $trigger->subscriptions->count();
        \Log::info("✅ Trigger '{$triggerName}' encontrado com {$count} subscrições.");

        $auth = [
            'VAPID' => [
                'subject' => config('webpush.vapid.subject'),
                'publicKey' => config('webpush.vapid.public_key'),
                'privateKey' => config('webpush.vapid.private_key'),
            ],
        ];

        $webPush = new WebPush($auth);

        foreach ($trigger->subscriptions as $sub) {
            $ps = $sub->pushSubscription;
            if (!$ps) continue; // segurança

            $subscription = Subscription::create([
                'endpoint' => $ps->endpoint,
                'publicKey' => $ps->public_key,
                'authToken' => $ps->auth_token,
                'contentEncoding' => 'aesgcm',
            ]);

            $webPush->queueNotification($subscription, json_encode([
                'title' => $title,
                'body' => $body,
                'url' => $url,
            ]));
        }

        foreach ($webPush->flush() as $report) {
            $endpoint = $report->getRequest()->getUri()->__toString();
            if (!$report->isSuccess()) {
                \Log::warning("❌ Push falhou: {$endpoint} - " . $report->getReason());
            } else {
                \Log::info("✅ Push enviado: {$endpoint}");
            }
        }
    }
}
