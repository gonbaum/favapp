<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class profilesController extends Controller
{
    public function index($user)
    {
        $user = User::findOrFail($user);
        #dd($user);
        return view('profiles.index', [
            'user' => $user,
        ]);
    }
}
