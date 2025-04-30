<?php

namespace App\Http\Controllers;

use App\Models\Tarefa;
use Illuminate\Http\Request;

class TarefaController extends Controller
{
    // 📋 Listar todas as tarefas
    public function index(Request $request)
    {
        $query = Tarefa::query()->latest();

        if ($request->filled('estado')) {
            $query->where('estado', $request->estado);
        }

        if ($request->filled('prioridade')) {
            $query->where('prioridade', $request->prioridade);
        }

        if ($request->filled('data_vencimento')) {
            $query->whereDate('data_vencimento', $request->data_vencimento);
        }

        $tarefas = $query->get();

        if ($request->ajax()) {
            return view('tarefas.tarefas-lista', compact('tarefas'))->render();
        }

        return view('tarefas.index', compact('tarefas'));
    }



    // ➕ Mostrar o formulário de criação
    public function create()
    {
        return view('tarefas.create');

    }

    // 💾 Armazenar nova tarefa
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'prioridade' => 'required|in:alta,media,baixa',
            'data_vencimento' => 'nullable|date',
        ]);

        Tarefa::create([
            'titulo' => $request->titulo,
            'descricao' => $request->descricao,
            'prioridade' => $request->prioridade,
            'data_vencimento' => $request->data_vencimento,
            'estado' => 'pendente',
        ]);

        return redirect()->route('tarefas.index')->with('success', 'Tarefa criada com sucesso!');
    }

    // ✏️ Mostrar o formulário de edição
    public function edit(Tarefa $tarefa)
    {
        return view('tarefas.edit', compact('tarefa'));
    }

    // 🔄 Atualizar a tarefa
    public function update(Request $request, Tarefa $tarefa)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'data_vencimento' => 'nullable|date',
            'prioridade' => 'nullable|in:baixa,média,alta',
        ]);

        $tarefa->update($request->only(['titulo', 'descricao', 'data_vencimento', 'prioridade']));

        return redirect()->route('tarefas.index')->with('success', 'Tarefa atualizada com sucesso!');
    }

    public function show(Tarefa $tarefa)
    {
        return view('tarefas.show', compact('tarefa'));
    }


    // 🗑️ Eliminar tarefa
    public function destroy(Tarefa $tarefa)
    {
        $tarefa->delete();
        return redirect()->route('tarefas.index')->with('success', 'Tarefa removida com sucesso!');
    }

    // ✅ Marcar como concluída (opcional)
    public function concluir(\App\Models\Tarefa $tarefa)
    {
        $tarefa->update(['estado' => 'concluida']);

        return redirect()->route('tarefas.index')->with('success', 'Tarefa marcada como concluída!');
    }


}
