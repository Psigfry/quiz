<?php
namespace App\Http\Controllers;

use App\Models\Quiz;

class QuizQuestionController extends Controller
{
    public function show($id, $number)
    {
        $quiz = Quiz::find($id);
        $question = $quiz->questions()->find($number);

        if ($number === 1){
            session()->forget("quiz_{$quiz->id}.results");
        }

        if (!$question) {
            return redirect()->route('quizzes.finish', $quiz->id);
        }

        return view('quizzes.question', [
            'quiz' => $quiz,
            'question' => $question,
            'number' => $number
        ]);
    }

    public function answer($id, $number){
        $quiz = Quiz::find($id);

        $isCorrect = request('answer') === '1';

        session()->push("quiz_{$quiz->id}.results", $isCorrect);

        return redirect()->route('quizzes.question', [
            'id' => $quiz->id,
            'number' => $number + 1
        ]);
    }
}
