<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NotificationTrigger;

class NotificationTriggerSeeder extends Seeder
{
    public function run(): void
    {
        $triggers = [
            [
                'name' => 'tarefa_criada',
                'description' => 'Disparado quando uma nova tarefa é criada.',
            ],
            [
                'name' => 'tarefa_concluida',
                'description' => 'Disparado quando uma tarefa é marcada como concluída.',
            ],
            [
                'name' => 'tarefa_editada',
                'description' => 'Disparado quando uma tarefa é editada.',
            ],
            [
                'name' => 'tarefa_eliminada',
                'description' => 'Disparado quando uma tarefa é removida.',
            ],
        ];

        foreach ($triggers as $trigger) {
            NotificationTrigger::firstOrCreate(
                ['name' => $trigger['name']],
                ['description' => $trigger['description']]
            );
            $this->command->info("✅ Trigger '{$trigger['name']}' criado.");
        }
    }
}
