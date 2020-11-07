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
            $fill_data['executed'] = 1;
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
        $validatedData = $request->validate([
            'title' => 'required|max:512',
        ]);

        $task = Task::create([
            'title' => $request->title,
            'executed' => 0,
        ]);
        return redirect()->route('tasks.index');
    }

    /**
     * 削除
     *
     * @param integer $id
     * @return void
     */
    public function destroy(int $id)
    {
        Task::destroy($id);

        return redirect()->route('tasks.index');
    }
}
