<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    protected $fillable = [
        'quiz_id',
        'user_id',
        'score',
        'correct_answer',
        'total_questions',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
}
