<?php

namespace App\Repositories\Task;

use App\Task;

class TaskRepository implements TaskRepositoryInterface
{
  protected $task;

  public function __construct(Task $task)
  {
    $this->task = $task;
  }

  public function updateShareStat($id,$status=1)  //シェアされたのかを判別するカラムである（is_shared）を更新するメソッド
  {
      $result = $this->task->where('id',$id)->where('is_shared','!=',1)->update([
          'is_shared' => $status
          ]);
      return !empty($result);
  }

}