<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  
    }

    public function create() 
    {
        return view('posts.create');
    }

    #This store function will be refactored as a like function, unless we created it separatedly

    public function store() 
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);
        
        $imagePath = request('image')->store('uploads', 'public');

        #Auth function create post through authenticated user and builds the relations automatically in the DB 
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }
}
