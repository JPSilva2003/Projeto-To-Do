<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', __('messages.app_title'))</title>

    @PwaHead

    {{-- 🔑 Meta tag com a chave pública VAPID --}}
    <meta name="vapid-public-key" content="{{ config('webpush.vapid.public_key') }}">

    {{-- 🔐 Meta CSRF para requisições JS --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<nav>
    <div class="nav-left">
        <a href="{{ url('/') }}" class="logo">📋 {{ __('messages.app_title') }}</a>
        <a href="{{ route('idiomas.gestao') }}" class="language-link">🌐 @lang('messages.language')</a>
    </div>

    <div class="nav-center">
        @php
        $languages = \App\Models\Idioma::where('ativo', true)->get();
        @endphp
        <form>
            <select onchange="window.location.href=this.value;">
                @foreach ($languages as $idioma)
                <option value="{{ route('lang.change', $idioma->codigo) }}" {{ app()->getLocale() === $idioma->codigo ? 'selected' : '' }}>
                    {{ strtoupper($idioma->codigo) }} {{ $idioma->nome }}
                </option>
                @endforeach
            </select>
        </form>
    </div>

    <div class="nav-right">
        <a href="{{ route('tarefas.create') }}" class="btn">➕ {{ __('messages.new_task') }}</a>
    </div>
</nav>

<main>
    @yield('content')
</main>

@yield('scripts')
@RegisterServiceWorkerScript

{{-- 🚀 Registro do Service Worker --}}
<script>
    if ('serviceWorker' in navigator && 'PushManager' in window) {
        window.addEventListener('load', async () => {
            await forceNewSubscription();
        });
    }

    async function forceNewSubscription() {
        try {
            const registration = await navigator.serviceWorker.register('/service-worker.js');
            console.log('✅ Service Worker registrado:', registration);

            const existingSubscription = await registration.pushManager.getSubscription();

            if (!existingSubscription) {
                const vapidKey = document.querySelector('meta[name="vapid-public-key"]').getAttribute('content');

                const newSubscription = await registration.pushManager.subscribe({
                    userVisibleOnly: true,
                    applicationServerKey: urlBase64ToUint8Array(vapidKey)
                });

                const response = await fetch('/save-subscription', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(newSubscription)
                });


                console.log('📡 Nova subscrição enviada ao servidor.', response.status);
            } else {
                console.log('ℹ️ Subscrição já existente.');
            }
        } catch (error) {
            console.error('❌ Erro ao registrar o Service Worker ou subscrever:', error);
        }
    }

    // 📦 Função auxiliar
    function urlBase64ToUint8Array(base64String) {
        const padding = '='.repeat((4 - base64String.length % 4) % 4);
        const base64 = (base64String + padding).replace(/-/g, '+').replace(/_/g, '/');
        const rawData = window.atob(base64);
        const outputArray = new Uint8Array(rawData.length);
        for (let i = 0; i < rawData.length; ++i) {
            outputArray[i] = rawData.charCodeAt(i);
        }
        return outputArray;
    }
</script>


</body>

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

    .nav-left, .nav-center, .nav-right {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .nav-left {
        flex: 1;
    }

    .nav-center {
        flex: 1;
        justify-content: center;
    }

    .nav-right {
        flex: 1;
        justify-content: flex-end;
    }

    select {
        padding: 0.5rem 1rem;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 1rem;
    }

    .btn {
        background-color: #10b981;
        color: white;
        padding: 0.5rem 1rem;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 1rem;
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


    main {
        max-width: 1200px;
        margin: 2rem auto;
        padding: 0 1rem;
    }

    a.logo {
        font-size: 1.5rem;
        font-weight: bold;
        color: #4f46e5;
        text-decoration: none;
    }

    a.language-link {
        font-size: 0.95rem;
        color: #555;
        text-decoration: none;
    }

    a.language-link:hover {
        text-decoration: underline;
    }
</style>

</html>
