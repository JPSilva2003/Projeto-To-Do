<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'To-Do')</title>
</head>
<body>

<nav>
    <a href="{{ url('/') }}" class="text-xl font-bold text-indigo-700">📋 To-Do App</a>
    <a href="{{ route('tarefas.create') }}" class="btn btn-concluir">➕ Nova Tarefa</a>
</nav>

<main class="container">
    @if (request()->routeIs('tarefas.index'))

    <h1 class="title">📋 Lista de Tarefas</h1>

    @if(session('success'))
    <div class="success">{{ session('success') }}</div>
    @endif

    <!-- Filtros -->
    <form method="GET" id="filtroForm" class="mb-10">
        <div class="flex flex-wrap items-center gap-4">
            <div>
                <label for="estado" class="font-medium text-gray-700 block">Estado</label>
                <select name="estado" id="estado" class="auto-submit px-4 py-2 rounded-lg border border-gray-300 shadow-sm">
                    <option value="">🔄 Todos</option>
                    <option value="pendente">🕓 Pendente</option>
                    <option value="concluida">✅ Concluída</option>
                </select>
            </div>

            <div>
                <label for="prioridade" class="font-medium text-gray-700 block">Prioridade</label>
                <select name="prioridade" id="prioridade" class="auto-submit px-4 py-2 rounded-lg border border-gray-300 shadow-sm">
                    <option value="">Todas</option>
                    <option value="alta">Alta</option>
                    <option value="média">Média</option>
                    <option value="baixa">Baixa</option>
                </select>
            </div>

            <div>
                <label for="data_vencimento" class="font-medium text-gray-700 block">Data de Vencimento</label>
                <input type="date" name="data_vencimento" id="data_vencimento" class="auto-submit px-4 py-2 rounded-lg border border-gray-300 shadow-sm">
            </div>
        </div>
    </form>

    <!-- TAREFAS -->
    <div id="tarefasContainer">
        @include('tarefas.tarefas-lista', ['tarefas' => $tarefas])
    </div>

    @else
    @yield('content')
    @endif
</main>



<style>
    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #f9fafb;
        margin: 0;
        padding: 0;
    }
    nav {
        background: #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        padding: 1rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }
    .container {
        max-width: 1200px;
        margin: auto;
        padding: 0 1rem;
    }
    .title {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 2rem;
        text-align: center;
    }
    .success {
        background-color: #d1fae5;
        color: #065f46;
        border: 1px solid #10b981;
        padding: 1rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        text-align: center;
    }
    form#filtroForm {
        margin-bottom: 2rem;
        display: flex;
        gap: 1rem;
        align-items: flex-end;
        flex-wrap: wrap;
        justify-content: center;
    }
    form#filtroForm > div {
        flex: 1 1 200px;
        min-width: 180px;
    }
    select, input[type="date"] {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 1rem;
        width: 100%;
        box-sizing: border-box;
    }
    button {
        background-color: #4f46e5;
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 1rem;
        cursor: pointer;
    }
    button:hover {
        background-color: #4338ca;
    }
    .grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 1.5rem;
    }
    .card {
        background: #fff;
        border-radius: 12px;
        padding: 1.2rem;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .card h3 {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        color: #111827;
        word-break: break-word;
    }
    .card p {
        margin: 0.3rem 0;
        color: #374151;
        font-size: 0.9rem;
        word-break: break-word;
    }
    .estado {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        border-radius: 999px;
        font-size: 0.75rem;
        font-weight: bold;
    }
    .concluida {
        background-color: #d1fae5;
        color: #065f46;
    }
    .pendente {
        background-color: #fef3c7;
        color: #92400e;
    }
    .buttons {
        margin-top: 1rem;
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }
    .btn {
        text-align: center;
        padding: 0.6rem;
        border-radius: 6px;
        font-size: 0.85rem;
        color: white;
        text-decoration: none;
    }
    .btn-editar {
        background-color: #facc15;
    }
    .btn-editar:hover {
        background-color: #eab308;
    }
    .btn-remover {
        background-color: #ef4444;
    }
    .btn-remover:hover {
        background-color: #dc2626;
    }
    .btn-concluir {
        background-color: #10b981;
    }
    .btn-concluir:hover {
        background-color: #059669;
    }

    /* 🔥 MEDIA QUERIES */
    @media (max-width: 768px) {
        nav {
            flex-direction: column;
            gap: 1rem;
        }
        .grid {
            grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        }
    }

    @media (max-width: 500px) {
        .title {
            font-size: 1.5rem;
        }
        .success {
            font-size: 0.95rem;
        }
        .grid {
            grid-template-columns: 1fr;
        }
        .card {
            padding: 1rem;
        }
    }
</style>



<script>
    document.querySelectorAll('.auto-submit').forEach(el => {
        el.addEventListener('change', () => {
            const form = document.getElementById('filtroForm');
            const data = new URLSearchParams(new FormData(form)).toString();

            fetch(`{{ route('tarefas.index') }}?${data}`, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
                .then(res => res.text())
                .then(html => {
                    document.getElementById('tarefasContainer').innerHTML = html;
                })
                .catch(err => console.error('Erro ao filtrar:', err));
        });
    });
</script>



</body>
</html>
