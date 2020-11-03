<?php

namespace App\Http\Controllers\TasksControllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class ShowTasks extends Controller
{
    public function __invoke()
    {
        $tasks = Task::all();
        return view('tasks.index', ['tasks' => $tasks]);
    }
}
