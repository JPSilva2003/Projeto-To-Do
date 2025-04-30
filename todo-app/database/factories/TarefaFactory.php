<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tarefa>
 */
class TarefaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence(4),
            'descricao' => $this->faker->paragraph(),
            'prioridade' => $this->faker->randomElement(['alta', 'media', 'baixa']),
            'data_vencimento' => $this->faker->optional()->date(),
            'estado' => $this->faker->randomElement(['pendente', 'concluida']),
        ];
    }
}
