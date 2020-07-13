<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{   
    public function __construct() {
        $this->middleware('auth');
    }
    # Use the toggle method through authorized user to toggle between follow/not follow a profile.
    public function store(User $user)
    {
        return auth()->user()->following()->toggle($user->profile);
    }
}
