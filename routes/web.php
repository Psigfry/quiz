<?php

use App\Http\Controllers\ProfileController;
use App\Models\Quiz;
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
        $quizzes = Quiz::all();

        return view('quizzes.index', compact('quizzes'));
    })->name('quizzes.index');
    // один квиз
    Route::get('/quizzes/{id}', function ($id) {
        $quiz = Quiz::find($id);
        // dd($quiz->toArray());
        return view('quizzes.show', compact('quiz'));
    })->name('quizzes.show');

    Route::get('/quizzes/{id}/question/{number}', function ($id, $number) {
        $quiz = Quiz::find($id);
        $question = $quiz->questions()->find($number);

        if ($number === 1){
            session()->forget("quiz_{$quiz->id}.results");
        }

        if (!$question) {
            return redirect()->route('quizzes.finish', $quiz->id);
        }

        //dd($question);
        return view('quizzes.question', [
            'quiz' => $quiz,
            'question' => $question,
            'number' => $number
        ]);
    })->name('quizzes.question');

    Route::post('/quizzes/{id}/question/{number}', function ($id, $number) {
        $quiz = Quiz::find($id);

        $isCorrect = request('answer') === '1';

        session()->push("quiz_{$quiz->id}.results", $isCorrect);

        return redirect()->route('quizzes.question', [
            'id' => $quiz->id,
            'number' => $number + 1
        ]);
    })->name('quizzes.answer');

    Route::get('/quizzes/{id}/finish', function ($id) {
        $quiz = Quiz::find($id);

        $result = session("quiz_{$quiz->id}.results", []);

        $correct = array_sum($result);

        $total = count($result);

        session()->forget("quiz_{$quiz->id}.results");

        return view('quizzes.finish', [
            'quiz' => $quiz,
            'correct' => $correct,
            'total' => $total
        ]);
    })->name('quizzes.finish');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
