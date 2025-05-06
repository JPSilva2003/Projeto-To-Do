<div class="grid">
    @forelse($tarefas as $tarefa)
    <div class="card">
        <div>
            <h2 class="text-2xl font-semibold text-indigo-700 hover:underline">
                <a href="{{ route('tarefas.show', $tarefa) }}">
                    <h3>📌 {{ $tarefa->titulo }}</h3>
                </a>
            </h2>

            @if($tarefa->descricao)
            <p><strong>{{ __('messages.description') }}:</strong> {{ $tarefa->descricao }}</p>
            @endif

            <p>
                <strong>{{ __('messages.status') }}:</strong>
                <span class="estado {{ $tarefa->estado === 'concluida' ? 'concluida' : 'pendente' }}">
                    {{ $tarefa->estado === 'concluida' ? __('messages.completed') : __('messages.pending') }}
                </span>
            </p>

            <p><strong>📅 {{ __('messages.due_date') }}:</strong> {{ $tarefa->data_vencimento ?? __('messages.no_due_date') }}</p>

            <p><strong>⚡ {{ __('messages.priority') }}:</strong>
                @switch($tarefa->prioridade)
                @case('alta') {{ __('messages.high') }} @break
                @case('media') {{ __('messages.medium') }} @break
                @case('média') {{ __('messages.medium') }} @break
                @case('baixa') {{ __('messages.low') }} @break
                @default {{ ucfirst($tarefa->prioridade) }}
                @endswitch
            </p>
        </div>

        <div class="buttons">
            @if($tarefa->estado !== 'concluida')
            <form action="{{ route('tarefas.concluir', $tarefa) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-concluir">✅ {{ __('messages.complete') }}</button>
            </form>
            @endif

            <a href="{{ route('tarefas.edit', $tarefa) }}" class="btn btn-editar">✏️ {{ __('messages.edit') }}</a>

            <form action="{{ route('tarefas.destroy', $tarefa) }}" method="POST" onsubmit="return confirm('{{ __('messages.confirm_delete') }}')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-remover">🗑️ {{ __('messages.delete') }}</button>
            </form>
        </div>
    </div>
    @empty
    <p class="text-gray-600">{{ __('messages.no_tasks') }}</p>
    @endforelse
</div>
