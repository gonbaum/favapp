<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Like;
use App\User;
use Helper;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use DB; 

class LikesController extends Controller
{   

    function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function create()
    {   
        $data = request()->validate([
            'image_id' => 'required',
            'image_url' => 'required',
            'caption' => 'required',
        ]);
        
        auth()->user()->likes()->create([
            'image_id' => $data['image_id'],
            'image_url' => $data['image_url'],
            'caption' => $data['caption'],
        ]);
    }

    # Index view

    public function index() {

        # If the user is not a guest, return view for logged user:
        if (!Auth::guest()) {
            return view('welcome.user');
        }

        # Check if today is weekend:
        $today = Carbon::now();
        $isWeekend = Helper::is_weekend($today);

        # IF it's weekend:

        if ($isWeekend) {

            # Group users that have favorite the most in order. TODO: Filter those likes of last week only.
            $userRanking= User::with('likes')->withCount('likes')->orderBy('likes_count','desc')->get();

            # Return blade of weekends:
            return view('welcome.guest_weekend', compact('likes')); 

        }
        
        # IF it's a day of the week:

        # Set week start and end for filtering:
        Carbon::setWeekStartsAt(Carbon::SUNDAY);
        Carbon::setWeekEndsAt(Carbon::TUESDAY);
        
        # Get favorite images for last week period:
        $likes = Like::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();

        # Return blade of weekends:    
        return view('welcome.guest', compact('likes')); 

        
    }

}   
    
