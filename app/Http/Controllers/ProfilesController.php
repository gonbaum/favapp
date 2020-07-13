<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;

class profilesController extends Controller
{   
    # The syntax below allow us to avoid the findOrFail($user) query, by allowing Laravel to do it for us by indicating the model. So same results, easier syntax.
    # Since I'm already requiring the User model on the top of the file, I don't need to specify the path '\App\User'.
    # Further, I also use the compact() syntax to show a different possible syntax.
    public function index(User $user)
    {   
        # Does the authorized user contains the actual user id among their 'followings':
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        # Cache arguments: key, time, callback
        $postsCount= Cache::remember(
            'count.post.' . $user->id, 
            now()->addSeconds(30), 
            function() use ($user) {
                return $user->posts->count();
             });
        $followersCount = Cache::Remember(
            'count.followers.' . $user->id, 
            now()->addSeconds(30), 
            function() use ($user) {
            return $user->profile->followers->count();
            });
        $followingCount = Cache::Remember(
            'count.following.' . $user->id, 
            now()->addSeconds(30), 
            function() use ($user) {
            return $user->following()->count();
            });
    
        # previous syntax without cache
        # $followersCount= $user->profile->followers->count();
        # $followingCount = $user->following()->count();

        return view('profiles.index', compact('user', 'follows', 'postsCount', 'followersCount', 'followingCount'));

    }

    # Below I'm not using the compact() syntax as in Index().
    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profiles.edit', [
            'user' => $user,
        ]);
    }

    # Laravel 5.8 validation rules at: https://laravel.com/docs/5.8/validation
    public function update(User $user)
    {   
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }
        
        # Workaround: override image path by using the array merge method and passing a second array with the new path.
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");

    }
}

