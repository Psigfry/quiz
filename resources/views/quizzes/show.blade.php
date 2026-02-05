@extends('layouts.app')

@section('content')
<section class="bg-gray-50 dark:bg-gray-900 p-4">
    <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 shadow rounded-lg p-6">

        <!-- Название -->
        <h1 class="text-2xl font-bold mb-4 text-gray-900 dark:text-white">
            {{ $quiz->title }}
        </h1>

        <!-- Параметры квиза -->
        <div class="space-y-2 text-gray-700 dark:text-gray-300 mb-6">
            <p><strong>Предмет:</strong> {{ $quiz->subject }}</p>
            <p><strong>Класс:</strong> {{ $quiz->grade }}</p>
            <p><strong>Сложность:</strong> {{ ucfirst($quiz->difficulty) }}</p>

            @php
                $points = match($quiz->difficulty) {
                    'легкий' => 10,
                    'средний' => 20,
                    'тяжелый' => 30,
                    default => 0,
                };
            @endphp

            <p><strong>Баллы за прохождение:</strong> {{ $points }}</p>
        </div>

        <!-- Описание -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white">Описание</h2>
            <p class="text-gray-700 dark:text-gray-300">
                {{ $quiz->description }}
            </p>
        </div>

        <!-- Инструкция -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white">Как проходит квиз</h2>
            <ul class="list-disc ml-5 text-gray-700 dark:text-gray-300 space-y-1">
                <li>После нажатия кнопки “Начать” появится первый вопрос.</li>
                <li>К каждому вопросу будет 4 варианта ответа.</li>
                <li>Выберите один вариант — система покажет, правильно или нет.</li>
                <li>После прохождения всех вопросов будет показан итог и полученные баллы.</li>
            </ul>
        </div>

        <!-- Кнопка начать -->
        <div class="text-center mt-8">
            <a href="{{route('quizzes.question', [$quiz->id, 1])}}"
               class="w-full block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                Начать квиз
            </a>
        </div>

        <div>
        <a href="{{route('quizzes.index')}}" class="button">
        Назад
        </a>

        <style>
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
        }

        .button:hover {
            background-color: #45a049;
        }
        </style>

            </div>
</section>
@endsection
