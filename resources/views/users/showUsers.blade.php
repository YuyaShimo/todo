@extends('layout')

@section('styles')
  @include('share.flatpickr.styles')
@endsection

@section('content')
　<div class="container">
　　<div class="row">
　　　<div class="col col-md-offset-3 col-md-6">
　　　　<nav class="panel panel-default">
　　　　　<div class="panel-heading">ユーザーページ</div>
　　　　　　<div class="panel-body">
　　　　　　　<input type="hidden" name="_token" value="od9Wc4qsnxKtBJqalcnv3dA0e54dLL6w228t3daj">             <div class="form-group">
　　　　　　　<label for="name">ユーザー名</label>
　　　　　　　<p>{{$item->name}}</p>
　　　　　　</div>
　　　　　　　<div class="form-group">
　　　　　　　　<label for="email">メールアドレス</label>
　　　　　　　　<p>{{$item->email}}</p>
　　　　　　</div>
　　　　　　　<a href="{{ route('users.editUsers') }}">ユーザー名を編集する</a>
　　　　　　</div>
　　　　</nav>
　　　</div>
　　</div>
　</div>
@endsection