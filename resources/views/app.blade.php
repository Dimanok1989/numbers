<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Все номера</title>

    <link href="{{ mix('/css/app.css', mix_path('hot')) }}" rel="stylesheet" />
</head>

<body>

    @yield('content')

    <script src="{{ mix('/js/manifest.js', mix_path('hot')) }}" defer></script>
    <script src="{{ mix('/js/vendor.js', mix_path('hot')) }}" defer></script>
    <script src="{{ mix('/js/app.js', mix_path('hot')) }}" defer></script>

    @yield('script')

</body>

</html>
