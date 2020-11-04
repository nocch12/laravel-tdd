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

    public function update(int $id, Request $request)
    {
        $task = Task::find($id);

        if($task === null) {
            abort(404);
        }

        $fill_data = [];

        if($request->has('title')) {
            $fill_data['title'] = $request->title;
        }

        if($request->executed) {
            $fill_data['executed'] = true;
        }

        if($fill_data) {
            $task->fill($fill_data);
            $task->save();
        }

        return redirect()->route('tasks.show', ['id' => $id]);
    }
}
