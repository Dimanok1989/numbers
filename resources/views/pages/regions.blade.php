@extends('app')

@section('title', 'Автомобильные коды регионов России')
@section('description', 'Таблица цифровых кодов регионов Российской Федерации на автомобильных номерах')
@section('keywords', 'Коды регионов России, Автомобильные коды регионов, Коды регионов России')

@section('content')

    <div class="bg-white max-w-screen-sm mx-auto p-5 rounded">

        <h1 class="mb-8 text-center text-2xl font-black">Автомобильные коды регионов России</h1>

        <div class="border-b border-gray-300">

            <table>

                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-2 text-gray-500">Код</th>
                        <th class="px-4 py-2 text-gray-500">Субъект Российской Федерации</th>
                        <th class="px-4 py-2 text-gray-500">Примечание</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-300">

                    @foreach ($regions ?? [] as $region)

                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-center">
                                <a href="/series/{{ $region->country }}/{{ $region->code }}" class="text-blue-500 hover:text-blue-700">{{ $region->code }}</a>
                            </td>
                            <td class="px-4 py-2">{{ $region->region_name }}</td>
                            <td class="px-4 py-2"><small class="opacity-50">{{ $region->comment }}</small></td>
                        </tr>

                    @endforeach

                </tbody>

            </table>
        </div>

    </div>

@endsection
