<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('messages.app_title') }}</title>
</head>
<body>
<h1>{{ __('messages.welcome') }}</h1>

<p>{{ __('messages.change_language') }}</p>

<a href="{{ route('lang.switch', 'pt') }}">🇵🇹 Português</a>
<a href="{{ route('lang.switch', 'en') }}">🇬🇧 English</a>
</body>
</html>
