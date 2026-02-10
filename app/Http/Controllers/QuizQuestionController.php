<?php
namespace App\Http\Controllers;

use App\Models\Answer;
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

        $answer = Answer::findOrFail(request('answer'));

        $isCorrect = (bool) $answer->is_correct;

        session()->put(
            "quiz_{$quiz->id}.results.$number",
            $isCorrect
        );

        return redirect()->route('quizzes.question', [
            'id' => $quiz->id,
            'number' => $number + 1
        ]);
    }
}
