<?php

namespace Database\Seeders;

use App\Models\Todo\Todo;
use App\Models\Todo\TodoItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $todo1 = Todo::create([
            'title' => 'Test 1'
        ]);

        TodoItem::create([
            'todo_id' => $todo1->id,
            'activity' => 'Sample 1'
        ]);

        TodoItem::create([
            'todo_id' => $todo1->id,
            'activity' => 'Sample 2'
        ]);

        TodoItem::create([
            'todo_id' => $todo1->id,
            'activity' => 'Sample 3'
        ]);

        $todo2 = Todo::create([
            'title' => 'Test 2'
        ]);

        TodoItem::create([
            'todo_id' => $todo2->id,
            'activity' => 'Sample 1'
        ]);

        TodoItem::create([
            'todo_id' => $todo2->id,
            'activity' => 'Sample 2'
        ]);
    }
}
