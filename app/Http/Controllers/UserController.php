<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class UserController extends Controller
{
    public function show($name): View 
    {
        $user = User::where('name', $name)->first();
        //dd($user);
        if (!$user) {
            return view('users.notfound');
        }

        return view('users.show', compact('user'));
    }
}
