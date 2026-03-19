<?php

namespace Database\Seeders;

use App\Models\QuizResult;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuizResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        QuizResult::insert([
            [
                'quiz_id' => 10,
                'user_id' => 1,
                'score' => 20,
                'correct_answer' => 10,
                'total_questions' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 5,
                'user_id' => 2,
                'score' => 10,
                'correct_answer' => 10,
                'total_questions' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 14,
                'user_id' => 3,
                'score' => 20,
                'correct_answer' => 10,
                'total_questions' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 16,
                'user_id' => 4,
                'score' => 20,
                'correct_answer' => 10,
                'total_questions' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 12,
                'user_id' => 5,
                'score' => 10,
                'correct_answer' => 10,
                'total_questions' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 4,
                'user_id' => 2,
                'score' => 20,
                'correct_answer' => 10,
                'total_questions' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 10,
                'user_id' => 3,
                'score' => 20,
                'correct_answer' => 10,
                'total_questions' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 7,
                'user_id' => 1,
                'score' => 10,
                'correct_answer' => 10,
                'total_questions' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 11,
                'user_id' => 5,
                'score' => 10,
                'correct_answer' => 10,
                'total_questions' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'quiz_id' => 9,
                'user_id' => 4,
                'score' => 20,
                'correct_answer' => 10,
                'total_questions' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
