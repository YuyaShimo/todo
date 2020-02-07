@extends('layout')

@section('styles')
  @include('share.flatpickr.styles')
@endsection

@section('content')
　<div class="container">
      <div class="row">
        <div class="col col-md-offset-3 col-md-6">
          <nav class="panel panel-default">
            <div class="panel-heading">ユーザー名編集ページ</div>
            <div class="panel-body">
              <form action="{{ route('users.updateUsers') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="title">新しいユーザー名を入力してください</label>
                  <input type="text" class="form-control" name="name" id="title" />
                </div>
                <div class="text-right">
                  <button type="submit" class="btn btn-primary">変更</button>
                  </div>
              </form>
            </div>
          </nav>
        </div>
      </div>
    </div>

@endsection