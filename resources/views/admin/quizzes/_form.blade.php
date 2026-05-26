@php
    $isEdit = isset($quiz) && $quiz;

    $oldQuestions = old('questions');

    if ($oldQuestions) {
        $questions = $oldQuestions;
    } elseif ($isEdit) {
        $questions = $quiz->questions->map(function ($question) {
            $answers = $question->answers->values();

            $correctIndex = $answers->search(function ($answer) {
                return (bool) $answer->is_correct;
            });

            return [
                'text' => $question->text,
                'answers' => [
                    $answers[0]->text ?? '',
                    $answers[1]->text ?? '',
                    $answers[2]->text ?? '',
                    $answers[3]->text ?? '',
                ],
                'correct_answer' => $correctIndex === false ? 0 : $correctIndex,
            ];
        })->toArray();
    } else {
        $questions = [[
            'text' => '',
            'answers' => ['', '', '', ''],
            'correct_answer' => 0,
        ]];
    }
@endphp

<div class="max-w-5xl mx-auto py-6 px-4">
    <h1 class="text-2xl font-bold mb-6">
        {{ $isEdit ? 'Редактирование квиза' : 'Создание квиза' }}
    </h1>

    @if ($errors->any())
        <div class="mb-6 p-4 rounded bg-red-100 text-red-800">
            <div class="font-semibold mb-2">Есть ошибки:</div>
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST"
          action="{{ $isEdit ? route('admin.quizzes.update', $quiz) : route('admin.quizzes.store') }}">
        @csrf
        @if($isEdit)
            @method('PUT')
        @endif

        <div class="bg-white shadow rounded p-6 mb-6">
            <h2 class="text-xl font-semibold mb-4">Основная информация</h2>

            <div class="mb-4">
                <label class="block mb-1 font-medium">Название</label>
                <input type="text"
                       name="title"
                       value="{{ old('title', $quiz->title ?? '') }}"
                       class="w-full border rounded p-2">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block mb-1 font-medium">Предмет</label>
                    <input type="text"
                           name="subject"
                           value="{{ old('subject', $quiz->subject ?? '') }}"
                           class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block mb-1 font-medium">Класс</label>
                    <input type="text"
                           name="grade"
                           value="{{ old('grade', $quiz->grade ?? '') }}"
                           class="w-full border rounded p-2">
                </div>

                <div>
                    <label class="block mb-1 font-medium">Сложность</label>
                    <input type="text"
                           name="difficulty"
                           value="{{ old('difficulty', $quiz->difficulty ?? '') }}"
                           class="w-full border rounded p-2">
                </div>
            </div>

            <div>
                <label class="block mb-1 font-medium">Описание</label>
                <textarea name="description"
                          rows="4"
                          class="w-full border rounded p-2">{{ old('description', $quiz->description ?? '') }}</textarea>
            </div>
        </div>

        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Вопросы</h2>

            <button type="button"
                    id="add-question"
                    class="px-4 py-2 bg-green-600 rounded">
                Добавить вопрос
            </button>
        </div>

        <div id="questions-container" class="space-y-6">
            @foreach($questions as $qIndex => $question)
                <div class="question-item bg-white shadow rounded p-6 border" data-index="{{ $qIndex }}">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">
                            Вопрос <span class="question-number">{{ $qIndex + 1 }}</span>
                        </h3>

                        <button type="button"
                                class="remove-question px-3 py-1 bg-red-600 text-white rounded">
                            Удалить
                        </button>
                    </div>

                    <div class="mb-4">
                        <label class="block mb-1 font-medium">Текст вопроса</label>
                        <textarea name="questions[{{ $qIndex }}][text]"
                                  rows="3"
                                  class="w-full border rounded p-2">{{ $question['text'] ?? '' }}</textarea>
                    </div>

                    <div class="space-y-3">
                        @for($aIndex = 0; $aIndex < 4; $aIndex++)
                            <div class="flex items-center gap-3">
                                <input type="radio"
                                       name="questions[{{ $qIndex }}][correct_answer]"
                                       value="{{ $aIndex }}"
                                    {{ (int)($question['correct_answer'] ?? 0) === $aIndex ? 'checked' : '' }}>

                                <div class="w-full">
                                    <label class="block mb-1 text-sm text-gray-600">
                                        Ответ {{ $aIndex + 1 }}
                                    </label>
                                    <input type="text"
                                           name="questions[{{ $qIndex }}][answers][{{ $aIndex }}]"
                                           value="{{ $question['answers'][$aIndex] ?? '' }}"
                                           class="w-full border rounded p-2">
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6 flex gap-3">
            <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded">
                {{ $isEdit ? 'Сохранить изменения' : 'Создать квиз' }}
            </button>

            <a href="{{ route('admin.quizzes.index') }}"
               class="px-5 py-2 bg-gray-300 text-gray-800 rounded">
                Отмена
            </a>
        </div>
    </form>
</div>

<template id="question-template">
    <div class="question-item bg-white shadow rounded p-6 border" data-index="__INDEX__">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">
                Вопрос <span class="question-number">__NUMBER__</span>
            </h3>

            <button type="button"
                    class="remove-question px-3 py-1 bg-red-600 text-white rounded">
                Удалить
            </button>
        </div>

        <div class="mb-4">
            <label class="block mb-1 font-medium">Текст вопроса</label>
            <textarea name="questions[__INDEX__][text]"
                      rows="3"
                      class="w-full border rounded p-2"></textarea>
        </div>

        <div class="space-y-3">
            <div class="flex items-center gap-3">
                <input type="radio" name="questions[__INDEX__][correct_answer]" value="0" checked>
                <div class="w-full">
                    <label class="block mb-1 text-sm text-gray-600">Ответ 1</label>
                    <input type="text" name="questions[__INDEX__][answers][0]" class="w-full border rounded p-2">
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="radio" name="questions[__INDEX__][correct_answer]" value="1">
                <div class="w-full">
                    <label class="block mb-1 text-sm text-gray-600">Ответ 2</label>
                    <input type="text" name="questions[__INDEX__][answers][1]" class="w-full border rounded p-2">
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="radio" name="questions[__INDEX__][correct_answer]" value="2">
                <div class="w-full">
                    <label class="block mb-1 text-sm text-gray-600">Ответ 3</label>
                    <input type="text" name="questions[__INDEX__][answers][2]" class="w-full border rounded p-2">
                </div>
            </div>

            <div class="flex items-center gap-3">
                <input type="radio" name="questions[__INDEX__][correct_answer]" value="3">
                <div class="w-full">
                    <label class="block mb-1 text-sm text-gray-600">Ответ 4</label>
                    <input type="text" name="questions[__INDEX__][answers][3]" class="w-full border rounded p-2">
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const container = document.getElementById('questions-container');
        const addButton = document.getElementById('add-question');
        const templateElement = document.getElementById('question-template');

        if (!container || !addButton || !templateElement) {
            return;
        }

        function bindRemoveButtons() {
            const buttons = container.querySelectorAll('.remove-question');

            buttons.forEach(button => {
                button.removeEventListener('click', handleRemoveQuestion);
                button.addEventListener('click', handleRemoveQuestion);
            });
        }

        function handleRemoveQuestion() {
            const items = container.querySelectorAll('.question-item');

            if (items.length <= 1) {
                alert('У квиза должен быть хотя бы один вопрос');
                return;
            }

            this.closest('.question-item').remove();
            reindexQuestions();
        }

        function reindexQuestions() {
            const items = container.querySelectorAll('.question-item');

            items.forEach((item, index) => {
                item.setAttribute('data-index', index);

                const numberNode = item.querySelector('.question-number');
                if (numberNode) {
                    numberNode.textContent = index + 1;
                }

                item.querySelectorAll('input, textarea').forEach(field => {
                    const currentName = field.getAttribute('name');
                    if (!currentName) return;

                    const updatedName = currentName.replace(/questions\[\d+\]/g, `questions[${index}]`);
                    field.setAttribute('name', updatedName);
                });
            });
        }

        addButton.addEventListener('click', function () {
            const index = container.querySelectorAll('.question-item').length;
            let html = templateElement.innerHTML;

            html = html.replace(/__INDEX__/g, index);
            html = html.replace(/__NUMBER__/g, index + 1);

            container.insertAdjacentHTML('beforeend', html);
            bindRemoveButtons();
        });

        bindRemoveButtons();
    });
</script>
