<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', ['tasks' => $tasks]);
    }

    public function show(int $id)
    {
        $task = Task::find($id);
        if ($task === null) {
            abort(404);
        }
        return view('tasks.show', ['task' => $task]);
    }
}
