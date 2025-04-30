<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Criar Nova Tarefa</title>
</head>
<body>
<div class="form-container">
    <h1>➕ Criar Nova Tarefa</h1>
    <form method="POST" action="{{ route('tarefas.store') }}">
        @csrf

        <label for="titulo">Título</label>
        <input type="text" name="titulo" required>

        <label for="descricao">Descrição</label>
        <textarea name="descricao" rows="4"></textarea>

        <label for="prioridade">Prioridade</label>
        <select name="prioridade">
            <option value="alta">Alta</option>
            <option value="media" selected>Média</option>
            <option value="baixa">Baixa</option>
        </select>

        <label for="data_vencimento">Data de Vencimento</label>
        <input type="date" name="data_vencimento">

        <button type="submit">💾 Guardar</button>
        <a href="{{ route('tarefas.index') }}" class="voltar">⬅ Voltar</a>
    </form>
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
    label {
        font-weight: 600;
        color: #374151;
        display: block;
        margin-bottom: 0.5rem;
        margin-top: 1rem;
    }
    input[type="text"],
    input[type="date"],
    textarea,
    select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 1rem;
        background-color: #f9fafb;
        box-sizing: border-box;
    }
    textarea {
        resize: vertical;
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
        margin-top: 1rem;
        margin-left: 1rem;
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
            font-size: 1.6rem;
        }
        button, .voltar {
            width: 100%;
            margin-left: 0;
            text-align: center;
        }
        .voltar {
            margin-top: 0.5rem;
        }
    }
</style>

</html>
