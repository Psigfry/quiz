<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Kyrlik',
            'email' => 'kyrlik@kyrlik.com',
            'password' => '12345'
        ]);

        User::factory()->create([
            'name' => '@wisk',
            'email' => 'wisk@wisk.com',
            'password' => '12345'
        ]);

        User::factory()->create([
            'name' => '@hozz8slepp',
            'email' => 'good@good.com',
            'password' => '12345'
        ]);

        User::factory()->create([
            'name' => '@prosyve',
            'email' => 'topp@topp.com',
            'password' => '12345'
        ]);

        User::factory()->create([
            'name' => '@alisenevv',
            'email' => 'mil@mil.com',
            'password' => '12345'
        ]);
    }
}
