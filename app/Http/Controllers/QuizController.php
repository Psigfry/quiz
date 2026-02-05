<?php
namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    // список квизов
    public function index()
    {
        $quizzes = Quiz::all();

        return view('quizzes.index', compact('quizzes'));
    }

    // страница квиза
    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);

        return view('quizzes.show', compact('quiz'));
    }

    public function finish($id){
        $quiz = Quiz::find($id);

        $result = session("quiz_{$quiz->id}.results", []);

        $correct = array_sum($result); // 18

        $total = count($result); // 20

        $score = 0;

        $percent = ($correct / $total) * 100;

        if( $percent >= 85 ){
            $score = match ($quiz->difficulty) {
                'легкий' => 10,
                'средний' => 20,
                'тяжелый' => 30,
                default => 0,
            };
        }

        QuizResult::create([
            'user_id' => auth()->id(),
            'quiz_id' => $id,
            'score' => $score,
            'correct_answer' => $correct,
            'total_questions' => $total,
        ]);

        session()->forget("quiz_{$quiz->id}.results");

        return view('quizzes.finish', [
            'quiz' => $quiz,
            'correct' => $correct,
            'total' => $total
        ]);

    }
}
