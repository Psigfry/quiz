<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;

class QuizQuestionsSeeder extends Seeder
{
    public function run(): void
    {
        // Находим нужный квиз
        $quiz = Quiz::where('title', 'История России — ключевые даты')->first();

        if (!$quiz) {
            dd('Квиз не найден! Убедитесь, что он создан в QuizSeeder.');
        }

        // ===============================
        // ВОПРОСЫ ДЛЯ "История России — ключевые даты"
        // ===============================

        $questions = [

            [
                'text' => 'В каком году произошло Крещение Руси?',
                'answers' => [
                    ['text' => '988', 'is_correct' => true],
                    ['text' => '862'],
                    ['text' => '1015'],
                    ['text' => '1240'],
                ],
            ],

            [
                'text' => 'В каком году состоялось нашествие Батыя?',
                'answers' => [
                    ['text' => '1240', 'is_correct' => true],
                    ['text' => '1380'],
                    ['text' => '1237'],
                    ['text' => '1480'],
                ],
            ],

            [
                'text' => 'Когда произошло Куликовское сражение?',
                'answers' => [
                    ['text' => '1380', 'is_correct' => true],
                    ['text' => '1480'],
                    ['text' => '1410'],
                    ['text' => '1327'],
                ],
            ],

            [
                'text' => 'В каком году началось правление Ивана Грозного как царя?',
                'answers' => [
                    ['text' => '1547', 'is_correct' => true],
                    ['text' => '1533'],
                    ['text' => '1613'],
                    ['text' => '1598'],
                ],
            ],

            [
                'text' => 'В каком году основан Санкт-Петербург?',
                'answers' => [
                    ['text' => '1703', 'is_correct' => true],
                    ['text' => '1721'],
                    ['text' => '1682'],
                    ['text' => '1714'],
                ],
            ],

            [
                'text' => 'В каком году состоялась Полтавская битва?',
                'answers' => [
                    ['text' => '1709', 'is_correct' => true],
                    ['text' => '1714'],
                    ['text' => '1699'],
                    ['text' => '1725'],
                ],
            ],

            [
                'text' => 'Когда произошло Отечественная война против Наполеона?',
                'answers' => [
                    ['text' => '1812', 'is_correct' => true],
                    ['text' => '1805'],
                    ['text' => '1825'],
                    ['text' => '1799'],
                ],
            ],

            [
                'text' => 'В каком году отменили крепостное право?',
                'answers' => [
                    ['text' => '1861', 'is_correct' => true],
                    ['text' => '1855'],
                    ['text' => '1881'],
                    ['text' => '1905'],
                ],
            ],

            [
                'text' => 'Когда произошла Октябрьская революция?',
                'answers' => [
                    ['text' => '1917', 'is_correct' => true],
                    ['text' => '1905'],
                    ['text' => '1922'],
                    ['text' => '1937'],
                ],
            ],

            [
                'text' => 'В каком году началась Великая Отечественная война?',
                'answers' => [
                    ['text' => '1941', 'is_correct' => true],
                    ['text' => '1939'],
                    ['text' => '1945'],
                    ['text' => '1953'],
                ],
            ],

        ];

        // Записываем вопросы и ответы в БД
        foreach ($questions as $data) {
            $question = $quiz->questions()->create([
                'text' => $data['text'],
            ]);

            $question->answers()->createMany($data['answers']);
        }
    }
}
