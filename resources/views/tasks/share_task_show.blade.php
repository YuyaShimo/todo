<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ToDo App</title>
  @yield('styles')
  <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
  <div class="column col-md-8">
        <div class="panel panel-default">
          <div class="panel-heading">タスク</div>
          <div class="panel-body">
            <div class="text-right">
            </div>
          </div>
          <table class="table">
            <thead>
            <tr>
              <th>タイトル</th>
              <th>状態</th>
              <th>期限</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
              <tr>
                <td>{{ $task->title }}</td>
                <td>
                  <span class="label {{ $task->status_class }}">{{ $task->status_label }}</span>
                </td>
                <td>{{ $task->formatted_due_date }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</body>