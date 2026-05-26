@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto py-6 px-4">
        <h1 class="text-2xl font-bold mb-6">Админ панель</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-center">
            <a href="{{route('admin.quizzes.index')}}"
               class="bg-blue-600 text-white p-4 rounded text-xl shadow border hover:bg-blue-700"
            >
                Управление квизами
            </a>

            <a href="{{route('admin.quizzes.index')}}"
               class="bg-blue-600 text-white p-4 rounded text-xl shadow border hover:bg-blue-700"
            >
                Управление пользователями
            </a>
        </div>
    </div>
@endsection
