@extends('layouts.app')

@section('content')

    <div class="max-w-xl mx-auto p-4 text-center">

        <h2 class="text-2xl font-bold mb-4">Квиз завершён!</h2>

        <p class="text-lg mb-2">
            Правильных ответов: <strong>{{ $correct }}</strong> из {{ $total }}
        </p>

        <a href="/quizzes" class="text-blue-600 underline mt-4 block">Вернуться к списку квизов</a>

    </div>

@endsection
