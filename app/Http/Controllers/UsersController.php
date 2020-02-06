<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class UsersController extends Controller
{
    public function showUsers()
    {
        $user = new User();
        $ret = $user->select(['id','name','email'])->where('id', Auth::id())->first();
        //dd($ret); //デバック用の関数
        return view('users/showUsers',['item' => $ret]);
    }
    public function editUsers()
    {
        return view('users/editUsers');
    }
    public function updateUsers(Request $request)
    {
        
        $name = $request->name;

        $user = new User();

        $edit_user = Auth::user();
        $edit_user->name = $name;
        $edit_user->save(); 

        return redirect()->route('users.editUsers');
    }
}
