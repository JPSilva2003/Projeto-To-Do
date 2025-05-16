<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NotificationTrigger;
use App\Models\PushSubscription;
use App\Models\TriggerSubscription;

class TriggerSubscriptionSeeder extends Seeder
{
    public function run(): void
    {
        $triggers = NotificationTrigger::all();
        $subscriptions = PushSubscription::all();

        if ($triggers->isEmpty() || $subscriptions->isEmpty()) {
            $this->command->warn('⚠️ Nenhum trigger ou subscrição encontrado.');
            return;
        }

        foreach ($triggers as $trigger) {
            foreach ($subscriptions as $sub) {
                $created = TriggerSubscription::firstOrCreate([
                    'notification_trigger_id' => $trigger->id,
                    'push_subscription_id' => $sub->id,
                ]);

                $this->command->info("🔗 Associado trigger '{$trigger->name}' à subscrição ID {$sub->id}");
            }
        }

        $this->command->info('✅ Todas as associações foram criadas com sucesso.');
    }
}
