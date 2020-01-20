<?php

namespace App\Http\Controllers;
use App\Http\Requests\CreateTask;
use Illuminate\Support\Facades\Auth;

use App\Folder;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public $current_folder_id;

    public function index(int $id)
    {
        $folders = Auth::user()->folders()->get();

        $current_folder = Folder::find($id);

        $tasks = $current_folder->tasks()->get();

        return view('tasks/index',[
            'folders' => $folders,
            'current_folder_id' => $current_folder->id,
            'tasks' => $tasks,
        ]);
    }
    public function showCreateForm(int $id)
    {
        return view('tasks/create',[
            'folder_id' => $id
        ]);
    }
    public function create(int $id, CreateTask $request)
{
    $current_folder = Folder::find($id);

    $task = new Task();
    $task->title = $request->title;
    $task->due_date = $request->due_date;

    $current_folder->tasks()->save($task);

    return redirect()->route('tasks.index', [
        'id' => $current_folder->id,
    ]);
}
public function showEditForm(int $id, int $task_id)
{
    $task = Task::find($task_id);

    return view('tasks/edit',[
        'task' => $task,
    ]);
}

}
