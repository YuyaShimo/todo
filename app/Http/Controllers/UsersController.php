<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{
    public function showUsers()
    {
        $users = new User();
        $ret = $users->select(['id','name','email'])->where('id', Auth::id())->first();
        //dd($ret); //デバック用の関数
        return view('users/showUsers',['item' => $ret]);
    }
}
