<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Tarefa;

class TarefaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function uma_tarefa_pode_ser_criada()
    {
        $dados = [
            'titulo' => 'Nova Tarefa de Teste',
            'descricao' => 'Descrição opcional',
            'prioridade' => 'alta',
            'data_vencimento' => now()->addDays(2)->format('Y-m-d')
        ];

        $response = $this->post(route('tarefas.store'), $dados);

        $response->assertRedirect(route('tarefas.index'));
        $this->assertDatabaseHas('tarefas', [
            'titulo' => 'Nova Tarefa de Teste',
            'descricao' => 'Descrição opcional',
            'prioridade' => 'alta',
            'estado' => 'pendente' // estado padrão
        ]);
    }

    /** @test */
    public function uma_tarefa_pode_ser_editada()
    {
        $tarefa = Tarefa::factory()->create([
            'titulo' => 'Original',
            'descricao' => 'Descrição inicial',
            'prioridade' => 'media'
        ]);

        $response = $this->put(route('tarefas.update', $tarefa), [
            'titulo' => 'Atualizado',
            'descricao' => 'Nova descrição',
            'prioridade' => 'baixa',
            'data_vencimento' => now()->addDays(3)->format('Y-m-d')
        ]);

        $response->assertRedirect(route('tarefas.index'));
        $this->assertDatabaseHas('tarefas', [
            'id' => $tarefa->id,
            'titulo' => 'Atualizado',
            'descricao' => 'Nova descrição',
        ]);
    }

    /** @test */
    public function uma_tarefa_pode_ser_removida()
    {
        $tarefa = Tarefa::factory()->create();

        $response = $this->delete(route('tarefas.destroy', $tarefa));

        $response->assertRedirect(route('tarefas.index'));
        $this->assertDatabaseMissing('tarefas', [
            'id' => $tarefa->id,
        ]);
    }

    /** @test */
    public function filtrar_por_estado_prioridade_e_data()
    {
        $hoje = now()->format('Y-m-d');

        // Esta deve aparecer nos resultados
        Tarefa::factory()->create([
            'titulo' => 'Deve aparecer',
            'estado' => 'pendente',
            'prioridade' => 'alta',
            'data_vencimento' => $hoje,
        ]);

        // Esta deve ser filtrada
        Tarefa::factory()->create([
            'titulo' => 'Não deve aparecer',
            'estado' => 'concluida',
            'prioridade' => 'baixa',
            'data_vencimento' => now()->addDay()->format('Y-m-d'),
        ]);

        $response = $this->get(route('tarefas.index', [
            'estado' => 'pendente',
            'prioridade' => 'alta',
            'data_vencimento' => $hoje,
        ]), [
            'HTTP_X-Requested-With' => 'XMLHttpRequest'
        ]);

        $response->assertStatus(200);
        $response->assertSee('Deve aparecer');
        $response->assertDontSee('Não deve aparecer');
    }

    /** @test */
    public function uma_tarefa_pode_ser_marcada_como_concluida()
    {
        $tarefa = Tarefa::factory()->create([
            'estado' => 'pendente',
        ]);

        $response = $this->patch(route('tarefas.concluir', $tarefa));

        $response->assertRedirect(route('tarefas.index'));

        $this->assertDatabaseHas('tarefas', [
            'id' => $tarefa->id,
            'estado' => 'concluida',
        ]);
    }


}
