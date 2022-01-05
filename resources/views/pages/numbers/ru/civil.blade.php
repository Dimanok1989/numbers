@extends('pages.number')

@php
$title = $number_rus . $region . ' - Информация о номере';
@endphp

@section('header')
    <div class="bg-neutral-100 border-b">
        <div class="max-w-screen-sm mx-auto p-5">
            {{ $number_rus . $region }}
        </div>
    </div>
@endsection

@section('content')
    <div class="max-w-screen-sm mx-auto p-5 mt-3">

        <div class="text-center">

            <div class="big-number-rus civil-rus">

                <div class="big-number-rus-series text-8xl">

                    <small>{{ $number_rus[0] . $number_rus[1] }}</small>
                    <span>{{ $number_rus[2] }}</span>
                    <span>{{ $number_rus[3] }}</span>
                    <span>{{ $number_rus[4] }}</span>
                    <small>{{ $number_rus[5] . $number_rus[6] }}</small>
                    <small>{{ $number_rus[7] . $number_rus[8] }}</small>

                </div>

                <div class="big-number-rus-region text-7xl">

                    <small>{{ $region }}</small>

                    <span class="flex justify-center items-center text-lg">

                        <span>RUS</span>

                        <img src="/img/flags/4x3/ru.svg" alt="rus" />

                    </span>

                </div>

            </div>

        </div>

    </div>
@endsection
