<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Página Inicial')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 font-sans">

<header class="bg-indigo-600 text-white py-4 shadow">
    <div class="container mx-auto px-4">
    </div>
</header>

<main class="container mx-auto p-6">
    @yield('content')
</main>

</body>
</html>
