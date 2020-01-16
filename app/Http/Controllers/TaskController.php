<?php

namespace App\Http\Controllers;

use App\Folder;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public $current_folder_id;

    public function index(int $id)
    {
        $folders = Folder::all();

        return view('tasks/index',[
            'folders' => $folders,
            'current_folder_id' => $id,
        ]);
    }
}
