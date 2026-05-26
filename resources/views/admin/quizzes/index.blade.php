@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-6 px-4">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Управление квизами</h1>

            <a href="{{ route('admin.quizzes.create') }}"
               class="px-4 py-2 bg-blue-600 text-white rounded">
                Создать квиз
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 p-3 rounded bg-green-100 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow rounded overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100">
                <tr>
                    <th class="text-left p-3">Название</th>
                    <th class="text-left p-3">Предмет</th>
                    <th class="text-left p-3">Класс</th>
                    <th class="text-left p-3">Сложность</th>
                    <th class="text-left p-3">Вопросов</th>
                    <th class="text-left p-3">Действия</th>
                </tr>
                </thead>
                <tbody>
                @forelse($quizzes as $quiz)
                    <tr class="border-t">
                        <td class="p-3">{{ $quiz->title }}</td>
                        <td class="p-3">{{ $quiz->subject }}</td>
                        <td class="p-3">{{ $quiz->grade }}</td>
                        <td class="p-3">{{ $quiz->difficulty }}</td>
                        <td class="p-3">{{ $quiz->questions_count }}</td>
                        <td class="p-3">
                            <div class="flex gap-3">
                                <a href="{{ route('admin.quizzes.edit', $quiz) }}"
                                   class="text-blue-600 hover:underline">
                                    Редактировать
                                </a>

                                <form action="{{ route('admin.quizzes.destroy', $quiz) }}"
                                      method="POST"
                                      onsubmit="return confirm('Удалить квиз?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline">
                                        Удалить
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">
                            Квизов пока нет
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $quizzes->links() }}
        </div>
    </div>
@endsection
