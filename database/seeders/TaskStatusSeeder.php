<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('task_statuses')->insert([
            'name' => 'новая',
        ]);
        DB::table('task_statuses')->insert([
            'name' => 'выполняется',
        ]);
        DB::table('task_statuses')->insert([
            'name' => 'тестирование',
        ]);
        DB::table('task_statuses')->insert([
            'name' => 'завершена',
        ]);
    }
}
