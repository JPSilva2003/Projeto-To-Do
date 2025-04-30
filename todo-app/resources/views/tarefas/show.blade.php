@extends('layouts.app')

@section('content')

<div class="form-container">
    <h1>📌 Detalhes da Tarefa</h1>

    <div>
        <label>Título:</label>
        <div class="field-value">{{ $tarefa->titulo }}</div>

        @if($tarefa->descricao)
        <label>Descrição:</label>
        <div class="field-value" style="white-space: pre-line;">{{ $tarefa->descricao }}</div>
        @endif

        <label>Prioridade:</label>
        <div class="field-value">{{ ucfirst($tarefa->prioridade) }}</div>

        <label>Data de Vencimento:</label>
        <div class="field-value">{{ $tarefa->data_vencimento ?? 'Sem data definida' }}</div>

        <label>Estado:</label>
        <div class="field-value">
            @if($tarefa->estado === 'concluida')
            <span class="badge concluida">✅ Concluída</span>
            @else
            <span class="badge pendente">🕓 Pendente</span>
            @endif
        </div>
    </div>

    <div class="actions">
        @if($tarefa->estado !== 'concluida')
        <form action="{{ route('tarefas.concluir', $tarefa) }}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit">✅ Concluir</button>
        </form>
        @endif

        <a href="{{ route('tarefas.edit', $tarefa) }}">
            <button class="edit">✏️ Editar</button>
        </a>

        <form action="{{ route('tarefas.destroy', $tarefa) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover esta tarefa?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete">🗑️ Remover</button>
        </form>
    </div>

    <a href="{{ route('tarefas.index') }}" class="voltar">⬅ Voltar à Lista</a>
</div>

<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f3f4f6;
        padding: 2rem;
        margin: 0;
    }
    .form-container {
        max-width: 600px;
        margin: auto;
        background: white;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    }
    h1 {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 2rem;
        color: #1f2937;
        text-align: center;
    }
    label {
        font-weight: 600;
        color: #374151;
        display: block;
        margin-bottom: 0.25rem;
        margin-top: 1rem;
    }
    .field-value {
        background-color: #f9fafb;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 0.75rem;
        font-size: 1rem;
        margin-bottom: 1.5rem;
        color: #111827;
    }
    .badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 9999px;
        font-weight: 600;
        font-size: 0.875rem;
    }
    .badge.pendente {
        background-color: #fef3c7;
        color: #92400e;
    }
    .badge.concluida {
        background-color: #d1fae5;
        color: #065f46;
    }
    .actions {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
    }
    button {
        background-color: #3b82f6;
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 1rem;
    }
    button:hover {
        background-color: #2563eb;
    }
    .edit {
        background-color: #facc15;
        color: #1f2937;
    }
    .edit:hover {
        background-color: #eab308;
    }
    .delete {
        background-color: #ef4444;
    }
    .delete:hover {
        background-color: #dc2626;
    }
    .voltar {
        display: inline-block;
        margin-top: 2rem;
        color: #6b7280;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
    }
    .voltar:hover {
        text-decoration: underline;
    }

    /* 🔥 Responsividade para mobile */
    @media (max-width: 600px) {
        body {
            padding: 1rem;
        }
        .form-container {
            padding: 1.5rem;
            border-radius: 8px;
        }
        h1 {
            font-size: 1.7rem;
        }
        .actions {
            flex-direction: column;
            align-items: stretch;
        }
        button, .edit, .delete {
            width: 100%;
            text-align: center;
        }
        .voltar {
            width: 100%;
            text-align: center;
        }
    }
</style>

@endsection
