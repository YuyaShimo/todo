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

  public function updateShareStat($id,$status=1)  //シェアされたのかを判別するカラムである（share_flg）を更新するメソッド
  {
      $result = $this->task->where('id',$id)->where('share_flg','!=',1)->update([
          'share_flg' => $status
          ]);
      return !empty($result);
  }

}