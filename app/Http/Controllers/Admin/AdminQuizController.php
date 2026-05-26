<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Http\Request;

class AdminQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quizzes = Quiz::withCount('questions')->latest()->paginate(20);

        return view('admin.quizzes.index', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.quizzes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        dd($request);

        $data = $this->validateQuiz($request);

//        dd($data);

        $quiz = Quiz::create([
            'title' => $data['title'],
            'subject' => $data['subject'],
            'grade' => $data['grade'],
            'difficulty' => $data['difficulty'],
            'description' => $data['description'] ?? null
        ]);

        foreach ($data['questions'] as $questionData){
            $questions = $quiz->questions()->create([
                'text' => $questionData['text']
            ]);

            foreach ($questionData['answers'] as $index => $answerData){
                $questions->answers()->create([
                    'text' => $answerData,
                    'is_correct' => (int)$questionData['correct_answer'] === $index,
                ]);
            }
        }

        return redirect()
            ->route('admin.quizzes.index')
            ->with('success', 'Квиз успешно создан');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $quiz)
    {
        $quiz->load('questions.answers');

        return view('admin.quizzes.edit', compact('quiz'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $quiz)
    {
        $data = $this->validateQuiz($request);

        $quiz->update([
            'title' => $data['title'],
            'subject' => $data['subject'],
            'grade' => $data['grade'],
            'difficulty' => $data['difficulty'],
            'description' => $data['description'] ?? null
        ]);

        $quiz->questions()->delete();

        foreach ($data['questions'] as $questionData){
            $questions = $quiz->questions()->create([
                'text' => $questionData['text']
            ]);

            foreach ($questionData['answers'] as $index => $answerData){
                $questions->answers()->create([
                    'text' => $answerData,
                    'is_correct' => (int)$questionData['correct_answer'] === $index,
                ]);
            }
        }

        return redirect()
            ->route('admin.quizzes.index')
            ->with('success', 'Квиз успешно обновлен');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()
            ->route('admin.quizzes.index')
            ->with('success', 'Квиз удален');
    }

    public function validateQuiz(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'grade' => ['required', 'string', 'max:255'],
            'difficulty' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],

            'questions' => ['required', 'array', 'min:1'],
            'questions.*.text' => ['required', 'string'],

            'questions.*.answers' => ['required', 'array', 'size:4'],
            'questions.*.answers.*' => ['required', 'string'],

            'questions.*.correct_answer' => ['required', 'integer', 'between:0,3'],
        ]);

        return $data;
    }
}
