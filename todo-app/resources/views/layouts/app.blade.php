<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'To-Do')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans leading-relaxed tracking-wide">

<!-- NAVBAR -->
<nav class="bg-white shadow-md py-4 mb-8">
    <div class="container mx-auto flex justify-between items-center px-6">
        <a href="{{ url('/') }}" class="text-2xl font-bold text-indigo-700 flex items-center gap-2">
            📋 To-Do App
        </a>
    </div>
</nav>

<!-- CONTEÚDO PRINCIPAL -->
<main class="container mx-auto px-6">
    @if (request()->routeIs('tarefas.index'))
    <h1 class="text-4xl font-bold mb-8 text-gray-800">📋 Lista de Tarefas</h1>

    @if(session('success'))
    <div class="bg-green-100 border border-green-300 text-green-800 px-6 py-4 rounded-lg shadow mb-6">
        {{ session('success') }}
    </div>
    @endif

    <!-- FILTRO POR ESTADO -->
    <form method="GET" action="{{ route('tarefas.index') }}" class="mb-10">
        <div class="flex items-center gap-4 flex-wrap">
            <label for="estado" class="font-medium text-gray-700">Filtrar por estado:</label>
            <select name="estado" id="estado" class="px-4 py-2 rounded-lg border border-gray-300 shadow-sm focus:ring-2 focus:ring-indigo-400 focus:outline-none">
                <option value="">🔄 Todos</option>
                <option value="pendente" {{ request('estado') === 'pendente' ? 'selected' : '' }}>🕓 Pendente</option>
                <option value="concluida" {{ request('estado') === 'concluida' ? 'selected' : '' }}>✅ Concluída</option>
            </select>
            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg shadow transition">
                🔍 Filtrar
            </button>
        </div>
    </form>

    @php
    $tarefasQuery = \App\Models\Tarefa::query()->latest();

    if (request('estado') === 'pendente') {
    $tarefasQuery->where('estado', 'pendente');
    } elseif (request('estado') === 'concluida') {
    $tarefasQuery->where('estado', 'concluida');
    }

    $tarefas = $tarefasQuery->get();
    @endphp

    <ul class="space-y-6">
        @forelse($tarefas as $tarefa)
        <li class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition border border-gray-200">
            <div class="flex justify-between items-start gap-6">
                <div class="flex-1 space-y-2">
                    <h2 class="text-2xl font-semibold text-gray-800">📌 {{ $tarefa->titulo }}</h2>
                    @if($tarefa->descricao)
                    <p class="text-gray-600">{{ $tarefa->descricao }}</p>
                    @endif
                    <div class="text-sm text-gray-500 mt-2 space-y-1">
                        <p>
                            <span class="font-medium text-gray-700">Estado:</span>
                            @if($tarefa->estado === 'concluida')
                            <span class="inline-block px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">
                                    ✅ Concluída
                                </span>
                            @else
                            <span class="inline-block px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-bold">
                                    🕓 Pendente
                                </span>
                            @endif
                        </p>
                        <p>📅 <strong>Vencimento:</strong> {{ $tarefa->data_vencimento ?? 'Sem data' }}</p>
                        <p>⚡ <strong>Prioridade:</strong> {{ ucfirst($tarefa->prioridade) ?? 'Sem prioridade' }}</p>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    @if($tarefa->estado !== 'concluida')
                    <form action="{{ route('tarefas.concluir', $tarefa) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm transition shadow">
                            ✅ Concluir
                        </button>
                    </form>
                    @endif

                    <a href="{{ route('tarefas.edit', $tarefa) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg text-sm transition shadow">
                        ✏️ Editar
                    </a>

                    <form action="{{ route('tarefas.destroy', $tarefa) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja remover esta tarefa?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm transition shadow">
                            🗑️ Remover
                        </button>
                    </form>
                </div>
            </div>
        </li>
        @empty
        <li class="text-gray-600 text-center text-lg">Ainda não há tarefas para esse estado.</li>
        @endforelse
    </ul>

    @else
    @yield('content')
    @endif
</main>

</body>
</html>
