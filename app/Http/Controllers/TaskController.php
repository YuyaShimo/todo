<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTask;
use Illuminate\Support\Facades\Auth;
use App\Folder;
use App\Http\Requests\EditTask;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Repositories\Task\TaskRepositoryInterface;

class TaskController extends Controller
{
    public function __construct(TaskRepositoryInterface $task_repo)
    {
        $this->task_repo = $task_repo;
    }

    public function index(Folder $folder)
    {
        $folders = Auth::user()->folders()->get();

        $tasks = $folder->tasks()->get();

        return view('tasks/index',[
            'folders' => $folders,
            'current_folder_id' => $folder->id,
            'tasks' => $tasks,
        ]);
    }

    public function showCreateForm(Folder $folder)
    {
        return view('tasks/create',[
            'folder_id' => $folder->id,
        ]);
    }

    public function create(Folder $folder, CreateTask $request)
    {

        $task = new Task();
        $task->title = $request->title;
        $task->due_date = $request->due_date;

        $folder->tasks()->save($task);

        return redirect()->route('tasks.index', [
            'id' => $folder->id,
        ]);
    }

    public function showEditForm(Folder $folder, Task $task)
    {
    
        $this->checkRelation($folder, $task);

        return view('tasks/edit',[
            'task' => $task,
        ]);
    }

    public function edit(Folder $folder, Task $task, EditTask $request)
    {
    
        $this->checkRelation($folder, $task);

        $task->title = $request->title;
        $task->status = $request->status;
        $task->due_date = $request->due_date;
        $task->save();

        return redirect()->route('tasks.index',[
            'id' => $task->folder_id,
        ]);
    }

    private function checkRelation(Folder $folder, Task $task)
    {
        if($folder->id !== $task->folder_id) {
            abort(404);
        }
    }

    public function createShareUrl($folder,$task) //シェアボタン押下時にURLを生成
    {
        $this->task_repo->updateShareStat($task);

        $task_info_array = ([
            'task' => $task,
            'folders' => $folder
            ]);

        $crypt_key = encrypt($task_info_array);

        $share_url = route('tasks.shareshow',[
                'crypt_key' => $crypt_key,
            ]);

        return $share_url;
    } 

    public function showShareTask($crypt_key) //シェアしたURLを踏んだ人がtaskを閲覧できる（未ログインでも）
    {
        $task_info = decrypt($crypt_key);

        $share_task = Task::where('id',$task_info['task'])->where('is_shared',1)->first();
        
        if(empty($share_task))
        {
            abort(404);
        }
        return view('tasks/share_task_show',[
            'task' => $share_task,
        ]);
    }
}