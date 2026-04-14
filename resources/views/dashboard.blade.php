@extends('layouts.app')

@section('content')

    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-center text-2xl text-black">
                        Статистика квизов
                    </div>
                    <div class="grid mt-2 lg:grid-cols-4 text-center gap-4">
                        <div>Пройдено квизов: {{$completedQuizzes}} из {{$totalQuizzes}}</div>
                        <div>Кол-во уникальных очков: {{$totalScore}}</div>
                        <div>Средний %: {{$averagePercent}}</div>
                        <div>Лучший результат: {{$bestScore}}</div>
                    </div>
                    <div class="bg-white p-6 rounded shadow">
                        <div class="flex flex-col items-center">

                            <div style="width: 260px; height: 260px;">
                                <canvas id="quizProgressChart"></canvas>
                            </div>


                        </div>
                    </div>

                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

                    <script>

                        const completed = {{$completedQuizzes}};
                        const total = {{$totalQuizzes}};
                        const notCompleted = total - completed;
                        const ctx = document.getElementById('quizProgressChart');

                        new Chart(ctx, {
                            type: 'doughnut',
                            data: {
                                labels: ['Пройдено', 'Не пройдено'],
                                datasets: [{
                                    data: [completed, notCompleted],
                                    backgroundColor: [
                                        '#22c55e', // зелёный
                                        '#e5e7eb'  // серый
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'bottom'
                                    }
                                }
                            }
                        });
                    </script>
{{--                    @foreach($lastResults as $lastResult)--}}
{{--                        {{ $lastResult }}--}}
{{--                    @endforeach--}}
                </div>
            </div>
        </div>
    </div>
@endsection
