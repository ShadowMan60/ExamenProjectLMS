<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        $this->call(QuizSeeder::class);
        $this->call(AnswerSeeder::class);
        $this->call(AdminSeeder::class);

    }
}
