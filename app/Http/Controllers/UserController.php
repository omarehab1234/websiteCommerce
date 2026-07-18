<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function show(){
        $users = User::all();
        
        return view("user.index",['users' => $users]);
    }
    function makeAd(User $user){
        $user->update([
            'is_admin' => !$user->is_admin,
        ]);
        return back()->with('success', 'User updated successfully.');
    }
    function destroyDash(User $user){
        $user->delete();
        return back()->with('success', 'User has been Deleted successfully.');
    }
}
