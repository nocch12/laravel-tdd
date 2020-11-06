<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * 一覧
     *
     * @return void
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks.index', ['tasks' => $tasks]);
    }

    /**
     * 詳細
     *
     * @param integer $id
     * @return void
     */
    public function show(int $id)
    {
        $task = Task::find($id);
        if ($task === null) {
            abort(404);
        }
        return view('tasks.show', ['task' => $task]);
    }

    /**
     * 更新
     *
     * @param integer $id
     * @param Request $request
     * @return void
     */
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

    /**
     * 新規作成画面
     *
     * @param Request $request
     * @return void
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * 新規作成
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $task = Task::create([
            'title' => $request->title,
            'executed' => false,
        ]);
        return redirect()->route('tasks');
    }
}
