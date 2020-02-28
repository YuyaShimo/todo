<?php

namespace App\Repositories\Task;

interface TaskRepositoryInterface
{
  public function updateShareStat($id,$status=1); //シェアされたのかを判別するカラムである（share_flg）を更新するメソッド
}