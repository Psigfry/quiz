<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $userId = auth()->id();

        $results = QuizResult::where('user_id', $userId)->get();

        $totalQuizzes = Quiz::count();

        $completedQuizzes = QuizResult::where('user_id', $userId)->distinct()->count('user_id');

        $bestResults = QuizResult::where('user_id', $userId)
            ->select('quiz_id', DB::raw('MAX(score) as best_score'))
            ->groupBy('quiz_id')
            ->get();

        $totalScore = $bestResults->sum('best_score');

        $averagePercent = $results->count()
            ? round(
                $results->avg(function ($result) {
                    return ($result->correct_answer / $result->total_questions) * 100;
                }),
                1
            )
            : 0;

        $bestScore = $results->max('score');

        $lastResults = QuizResult::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalQuizzes',
            'completedQuizzes',
            'totalScore',
            'bestScore',
            'averagePercent',
            'lastResults'
        ));
    }



    public function rating()
    {
        $topUsers = QuizResult::select('user_id', DB::raw('SUM(score) as total_score'))
            ->groupBy('user_id')
            ->orderByDesc('total_score')
            ->with('user')
            ->limit(100)
            ->get();

        return view('rating', compact('topUsers'));
    }
}
