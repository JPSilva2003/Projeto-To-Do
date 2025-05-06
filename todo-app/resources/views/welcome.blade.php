@extends('layouts.base')

@section('title', 'Bem-vindo')

@section('content')
<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', sans-serif;
        background-color: #f3f4f6;
    }

    .welcome-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 90vh;
        padding: 2rem;
        background: linear-gradient(to right, #eef2ff, #f3f4f6);
    }

    .welcome-box {
        background-color: white;
        padding: 3rem 2.5rem;
        border-radius: 1rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        text-align: center;
        max-width: 500px;
    }

    .welcome-box h1 {
        font-size: 2.5rem;
        font-weight: bold;
        color: #4f46e5;
        margin-bottom: 1rem;
    }

    .welcome-box p {
        font-size: 1.1rem;
        color: #6b7280;
        margin-bottom: 2rem;
    }

    .welcome-box a {
        display: inline-block;
        padding: 0.75rem 2rem;
        font-size: 1rem;
        font-weight: 600;
        background-color: #4f46e5;
        color: white;
        border-radius: 0.5rem;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }

    .welcome-box a:hover {
        background-color: #4338ca;
    }
</style>

<div class="welcome-container">
    <div class="welcome-box">

        <h1>👋 {{ __('messages.welcome') }}</h1>
        <p>{{ __('messages.welcome_text') }}</p>
        <a href="{{ route('tarefas.index') }}">📋 {{ __('messages.view_tasks') }}</a>
    </div>
</div>
@endsection
