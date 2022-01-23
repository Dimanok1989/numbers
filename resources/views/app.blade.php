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

    @if (env('APP_ENV') == 'production')
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript">
            (function(m, e, t, r, i, k, a) {
                m[i] = m[i] || function() {
                    (m[i].a = m[i].a || []).push(arguments)
                };
                m[i].l = 1 * new Date();
                k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(
                    k, a)
            })
            (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

            ym({{ env('YANDEX_METRIKA_ID') }}, "init", {
                clickmap: true,
                trackLinks: true,
                accurateTrackBounce: true,
                webvisor: true
            });
        </script>
        <noscript>
            <div><img src="https://mc.yandex.ru/watch/{{ env('YANDEX_METRIKA_ID') }}" style="position:absolute; left:-9999px;" alt="" /></div>
        </noscript>
        <!-- /Yandex.Metrika counter -->
    @endif

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
