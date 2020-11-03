<?php

namespace App\Http\Controllers\TasksControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowTasks extends Controller
{
    public function __invoke()
    {
        return "all tasks";
    }
}
