<?php

namespace App\Http\Controllers\TasksControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowTasks extends Controller
{
    public function __invoke()
    {
        $tasks = [
            (object) ['id' => 10, 'title' => 'テストタスク', 'executed' => false],
        ];
        return view('tasks.index', ['tasks' => $tasks]);
    }
}
