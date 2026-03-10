@extends('layouts.app')

@section('content')

<div class="max-w-xl mx-auto p-4">

    <h2 class="text-xl font-bold mb-4">
        Вопрос {{ $number }}: {{ $question->text }}
    </h2>

    <form id="quiz-form" method="post" action="{{ route('quizzes.answer', [$quiz, $number]) }}">
        @csrf

        <div class="space-y-3">
            @foreach($question->answers as $answer)
                <label
                    class="answer-option block p-3 border rounded-lg cursor-pointer transition"
                    data-correct="{{$answer->is_correct}}"
                >
                    <input type="radio" name="answer" value="{{ $answer->id }}" required>
                    {{ $answer->text }}
                </label>
            @endforeach
        </div>

        <button id="submit-btn" type="submit"
            class="w-full mt-6 bg-blue-600 text-white py-2 rounded-lg">
            Ответить →
        </button>
    </form>

</div>

<script>
    const form = document.getElementById('quiz-form');
    const options = document.querySelectorAll('.answer-option');

    form.addEventListener('submit', function (e){
       e.preventDefault();

       const selected = document.querySelector('input[name="answer"]:checked');

        if (!selected) return;

        options.forEach(opt => opt.style.pointerEvents = 'none');

        const selectedLabel = selected.closest('.answer-option');

        const isCorrect = selectedLabel.dataset.correct === "1";

        if(isCorrect){
            selectedLabel.classList.add(
                'bg-green-500',
                'text-white',
                'border-green-500',
            );
        } else {
            selectedLabel.classList.add(
                'bg-red-500',
                'text-white',
                'border-red-500',
            );

            options.forEach(opt => {
                if(opt.dataset.correct === "1"){
                    opt.classList.add(
                        'bg-green-500',
                        'text-white',
                        'border-green-500',
                    );
                }
            })
        }

        setTimeout(() => {
            form.submit();
        }, 2000);
    });
</script>

@endsection
