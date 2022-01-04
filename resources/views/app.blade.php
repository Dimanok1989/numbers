<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', "Все номера")</title>

    @hasSection('description')
        <meta name="description" content="@yield('description')">
    @endif

    @hasSection('keywords')
        <meta name="keywords" content="@yield('keywords')">
    @endif

    <link href="{{ mix('/css/app.css', mix_path('hot')) }}" rel="stylesheet" />
</head>

<body class="bg-slate-50 min-h-screen">

    @yield('header')

    <div class="p-3">
        @yield('content')
    </div>

    <script src="{{ mix('/js/manifest.js', mix_path('hot')) }}" defer></script>
    <script src="{{ mix('/js/vendor.js', mix_path('hot')) }}" defer></script>
    <script src="{{ mix('/js/app.js', mix_path('hot')) }}" defer></script>

    @yield('script')

</body>

</html>
