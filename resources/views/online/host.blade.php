@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-6 py-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Онлайн-игра</h1>
            <p class="text-gray-500 mt-1">Передайте код комнаты участникам, чтобы они смогли подключиться.</p>
        </div>
        <div class="p-5 bg-green-100 border border-purple-200 rounded-xl text-center">
            <div class="text-sm text-green-500 mb-2">Код комнаты</div>
            <div class="text-4xl font-bold tracking-wider text-green-500"> {{$session->code}} </div>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6 text-center">
        <div class="p-4 bg-gray-100 rounded-lg">
            <div class="text-sm text-green-500 ">Квиз</div>
            <div class="font-semibold text-green-500"> {{$session->quiz->title}} </div>
        </div>
        <div class="p-4 bg-gray-100 rounded-lg">
            <div class="text-sm text-green-500 ">Статус</div>
            <div class="font-semibold text-green-500">
                @if($session->status === 'waiting')
                    Ожидание игроков
                @elseif($session->status === 'active')
                    Игра идёт
                @elseif($session->status === 'finished')
                    Игра завершена
                @endif
            </div>
        </div>
        <div>
            <h2 class="text-lg font-semibold mb-2">Участники</h2>
            <div class="p-4 bg-gray-50 rounded-lg text-gray-500">Пока никто не подключился.</div>
        </div>
        <button type="button" class="w-full bg-gray-300 text-gray-600 font-semibold py-3 px-4 rounded-lg cursor-not-allowed">
            Запустить игру
        </button>
    </div>
@endsection
