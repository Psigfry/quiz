@extends('layouts.app')

@section('content')

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center text-2xl text-black">
                        Статистика квизов
                    </div>
                    <div class="grid grid-cols-4 pt-4 text-center gap-4">
                        <div>Квизы: {{$totalQuizes}}</div>
                        <div>Очки: {{$totalScore}}</div>
                        <div>Средний %: {{$averagePercent}}</div>
                        <div>Лучший результат: {{$bestScore}}</div>
                    </div>
                    @foreach($lastResults as $lastResult)
                        {{ $lastResult }}
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
