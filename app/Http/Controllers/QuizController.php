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
}
