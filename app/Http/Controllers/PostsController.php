<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{



    # Index view
    public function index() {
        
        # Grab the users id's of the profiles that the auth user is following
        $users = auth()->user()->following()->pluck('profiles.user_id');
        
        # Grab the posts in that selected profiles and order them by creation date
        $posts = Post::whereIn('user_id', $users)->with('user')->orderBy('created_at', 'DESC')->paginate(4);
        
        return view('posts.index', compact('posts'));
    }

    public function create() 
    {
        return view('posts.create');
    }

    # TODO: This store function will be refactored as a like function, unless we created it separatedly
    public function store() 
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);
        
        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        #Auth function create post through authenticated user and builds the relations automatically in the DB 
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);

        return redirect('/profile/' . auth()->user()->id);
    }

    # The syntax between braces allows Laravel to fetch from the DB using Post model automatically
    public function show(\App\Post $post) 
    {   
        # You can also use the compact(post) syntax to send variables as arrays in the second parameter. Check PHP documentation.
        return view('posts.show', [
            'post' => $post, 
        ]);
    }
}
