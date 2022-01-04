@extends('app')

@section('title', $region . ' - Серии автомобильных номеров региона')

@section('header')

    <div class="bg-teal-600 text-center py-5 text-white">
        <h1 class="font-black text-3xl">{{ $code }} {{ $region }}</h1>
    </div>

@endsection

@section('content')

    <div class="flex justify-center flex-wrap">

        @foreach ($numbers as $row)

            @php
                if ($row['number'] === '000') {
                    $url = "/series/ru/{$code}/{$row['series']}";
                } else {
                    $url = "/number/ru/{$row['series']}/{$row['number']}/{$code}";
                }
            @endphp

            <a class="number-ru bg-white hover:shadow hover:bg-slate-100" href="{{ $url }}">

                <span class="flex justify-center number-ru-series px-1">
                    <b>{{ $row['one_rus'] }}</b>
                    @if ($row['number'] === '000')
                        <b class="opacity-30">0</b>
                        <b class="opacity-30">0</b>
                        <b class="opacity-30">0</b>
                    @else
                        <b>{{ $row['number'] }}</b>
                    @endif
                    <b>{{ $row['two_rus'] }}</b>
                    <b>{{ $row['three_rus'] }}</b>
                </span>

                <span class="number-ru-region px-1">
                    <b>{{ $row['code'] }}</b>
                    <span class="flex align-items-center ru-flag">
                        <span>RUS</span>
                        <span>
                            <img src="/img/flags/4x3/ru.svg" alt="rus" />
                        </span>
                    </span>
                </span>

                <h5 class="hidden">{{ $row['rus'] }}</h5>
                <h5 class="hidden">{{ $row['eng'] }}</h5>

            </a>

        @endforeach

    </div>


@endsection
