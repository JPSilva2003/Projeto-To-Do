<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            padding: 20px;
            color: #111827;
        }

        .container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        h2 {
            color: #2563eb;
        }

        ul {
            padding-left: 20px;
        }

        li {
            margin-bottom: 10px;
            line-height: 1.6;
        }

        .tarefa-titulo {
            font-weight: bold;
            color: #111827;
        }

        .descricao {
            color: #374151;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>📋 Tarefas Pendentes para Hoje</h2>
    <ul>
        @foreach ($tarefas as $tarefa)
        <li>
            <span class="tarefa-titulo">{{ $tarefa->titulo }}</span><br>
            <span class="descricao">{{ $tarefa->descricao }}</span>
        </li>
        @endforeach
    </ul>
</div>
</body>
</html>
