@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto p-4">

    <h2 class="text-xl font-bold mb-4">
        Вопрос {{ $number }}: {{ $question->text }}
    </h2>

    <form>
        @csrf

        <div class="space-y-3">
            @foreach($question->answers as $answer)
                <label class="block p-3 border rounded-lg cursor-pointer">
                    <input type="radio" name="answer" value="{{ $answer->is_correct ? 1 : 0 }}" required>
                    {{ $answer->text }}
                </label>
            @endforeach
        </div>

        <button type="submit"
            class="w-full mt-6 bg-blue-600 text-white py-2 rounded-lg">
            Ответить →
        </button>
    </form>

</div>

@endsection