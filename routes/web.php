<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $questions = \App\Models\Question::all();
    dd($questions);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // список всех квизов
    Route::get('/quizzes', function () {
        $quizzes = \App\Models\Quiz::all();

        return view('quizzes.index', compact('quizzes'));
    })->name('quizzes.index');
    // один квиз
    Route::get('/quizzes/{id}', function ($id) {
        $quiz = \App\Models\Quiz::find($id);
        // dd($quiz->toArray());
        return view('quizzes.show', compact('quiz'));
    })->name('quizzes.show');

    Route::get('/quizzes/{id}/question/{number}', function ($id, $number) {
        $question = \App\Models\Question::find($number);
        return view('quizzes.show', compact('quiz'));
    })->name('quizzes.show');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
