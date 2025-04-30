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
            <p><strong>Descrição:</strong> {{ $tarefa->descricao }}</p>
            @endif
            <p>
                <strong>Estado:</strong>
                <span class="estado {{ $tarefa->estado === 'concluida' ? 'concluida' : 'pendente' }}">
                    {{ ucfirst($tarefa->estado) }}
                </span>
            </p>
            <p><strong>📅 Vencimento:</strong> {{ $tarefa->data_vencimento ?? 'Sem data' }}</p>
            <p><strong>⚡ Prioridade:</strong> {{ ucfirst($tarefa->prioridade) ?? 'Sem prioridade' }}</p>
        </div>
        <div class="buttons">
            @if($tarefa->estado !== 'concluida')
            <form action="{{ route('tarefas.concluir', $tarefa) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-concluir">✅ Concluir</button>
            </form>
            @endif

            <a href="{{ route('tarefas.edit', $tarefa) }}" class="btn btn-editar">✏️ Editar</a>

            <form action="{{ route('tarefas.destroy', $tarefa) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover esta tarefa?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-remover">🗑️ Remover</button>
            </form>
        </div>
    </div>
    @empty
    <p class="text-gray-600">Ainda não há tarefas para esse estado.</p>
    @endforelse
</div>
