<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizQuestionController;
use App\Models\Quiz;
use App\Models\QuizResult;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $questions = \App\Models\Question::all();
    dd($questions);
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/rating', [DashboardController::class, 'rating'])->name('rating');

    Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index'); // список всех квизов
    Route::get('/quizzes/{id}', [QuizController::class, 'show'])->name('quizzes.show'); // один квиз
    Route::get('/quizzes/{id}/question/{number}', [QuizQuestionController::class, 'show'])->name('quizzes.question');
    Route::post('/quizzes/{id}/question/{number}', [QuizQuestionController::class, 'answer'])->name('quizzes.answer');
    Route::get('/quizzes/{id}/finish', [QuizController::class, 'finish'])->name('quizzes.finish');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
