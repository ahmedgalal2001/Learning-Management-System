<?php

namespace Database\Seeders;

use App\Models\Course;
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
        User::factory(10)->create();
        Course::factory(10)->create();
        User::factory()->admin([
            'name' => 'ahmed galal',
            'email' => 'ahmedgalal@iti.com',
        ])->create();
    }
}
