<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{
    public function showUsers()  //ユーザー情報を取得
    {
        $user = Auth::user();
        
        return view('users/showUsers',['user' => $user]);
    }

    public function editUsers()  //ユーザー名編集画面へ遷移する
    {
        return view('users/editUsers');
    }

    public function updateUsers(Request $request)  //ユーザー名を変更する
    {
        $name = $request->name;

        $edit_user = Auth::user();
        $edit_user->name = $name;
        $edit_user->save(); 

        return redirect()->route('users.editUsers');
    }
}
