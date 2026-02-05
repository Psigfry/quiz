@extends('layouts.app')

@section('content')
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-5">
        <div class="mx-auto max-w-screen-xl px-4 lg:px-12">

            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">

                <!-- Верхняя панель -->
                <div class="flex flex-col md:flex-row items-center justify-between p-4">
                    <div class="w-full md:w-1/3">
                        <input type="text"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                               placeholder="Поиск квизов..." disabled>
                    </div>

                    <div>
                        <a href="#"
                           class="text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">
                            Добавить квиз
                        </a>
                    </div>
                </div>

                <!-- Таблица -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">

                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th class="px-4 py-3">Название</th>
                            <th class="px-4 py-3">Предмет</th>
                            <th class="px-4 py-3">Класс</th>
                            <th class="px-4 py-3">Сложность</th>
                            <th class="px-4 py-3">Описание</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($quizzes as $quiz)
                            <tr class="border-b dark:border-gray-700">

                                <th class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $quiz->title }}
                                </th>

                                <td class="px-4 py-3">
                                    {{ $quiz->subject }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $quiz->grade }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $quiz->difficulty }}
                                </td>

                                <td class="px-4 py-3">
                                    {{ $quiz->description }}
                                </td>

                                <td class="px-4 py-3 flex items-center justify-end">
                                    <a href="{{route('quizzes.show', $quiz->id)}}"
                                       class="text-blue-600 hover:underline">
                                        Открыть →
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </section>
@endsection
