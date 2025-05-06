<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('Gestor de idiomas') ?? 'Gestão de Idiomas' }}</title>
</head>
<body>
<div class="form-container">
    <h1>🌍 Gestão de Idiomas</h1>

    <!-- Exportação -->
    <h2 style="margin-top: 2rem;">📤 Exportar Idioma</h2>
    <p>Escolhe um idioma para exportar os textos para CSV:</p>

    @foreach(\App\Models\Idioma::where('ativo', true)->get() as $idioma)
    <form method="GET" action="{{ route('idiomas.exportar', $idioma->codigo) }}" style="margin-bottom: 0.5rem;">
        <button type="submit">📄 Exportar {{ strtoupper($idioma->codigo) }} ({{ $idioma->nome }})</button>
    </form>
    @endforeach

    <hr style="margin: 2rem 0;">

    <!-- Importação -->
    <h2>📥 Importar Idioma</h2>
    <p>Carrega um ficheiro CSV para atualizar ou adicionar um idioma:</p>

    <form action="{{ route('idiomas.importar') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="locale">Novo Código do Idioma (ex: es, fr):</label>
        <input type="text" name="locale" id="locale" required>

        <label for="name">Nome do Idioma (ex: Espanhol, Francês):</label>
        <input type="text" name="name" id="name" required>

        <label for="file">Ficheiro CSV:</label>
        <input type="file" name="file" id="file" required>

        <button type="submit">📤 Importar CSV</button>
    </form>

    <p style="margin-top: 2rem; font-weight: 600;">Idiomas já registados:</p>
    <ul style="margin-top: 0.5rem;">
        @foreach(\App\Models\Idioma::all() as $idioma)
        <li>{{ strtoupper($idioma->codigo) }} - {{ $idioma->nome }}</li>
        @endforeach
    </ul>

    <a href="{{ route('tarefas.index') }}" class="voltar">⬅ Voltar</a>
</div>
</body>

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

    h2 {
        font-size: 1.4rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 1rem;
    }

    label {
        font-weight: 600;
        color: #374151;
        display: block;
        margin-bottom: 0.5rem;
        margin-top: 1rem;
    }

    input[type="text"],
    input[type="file"] {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 1rem;
        background-color: #f9fafb;
        box-sizing: border-box;
    }

    button {
        background-color: #10b981;
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 1rem;
        margin-top: 1rem;
    }

    button:hover {
        background-color: #059669;
    }

    .voltar {
        display: inline-block;
        margin-top: 1.5rem;
        color: #6b7280;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.95rem;
    }

    .voltar:hover {
        text-decoration: underline;
    }

    ul {
        padding-left: 1.2rem;
        color: #374151;
    }

    ul li {
        margin-bottom: 0.25rem;
    }

    @media (max-width: 600px) {
        body {
            padding: 1rem;
        }

        .form-container {
            padding: 1.5rem;
            border-radius: 8px;
        }

        h1 {
            font-size: 1.6rem;
        }

        button, .voltar {
            width: 100%;
            text-align: center;
        }
    }
</style>

</html>
