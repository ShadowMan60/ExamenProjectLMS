<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin QA',
            'email' => 'qa_admin@example.com',
            'password' => bcrypt('securePass!'),
            'role' => 'admin',
        ]);
    }
}
