<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    # Be careful of not overriding the guarded method without specifying validation rules for data passed through the controller
    protected $guarded = []; 

    public function profileImage()
    {
        $imagePath = ($this->image) ? $this->image : 'profile/979OfZMiZpf5uSmqE32m2W9qBDGNmYRbpk1BTHvf.png';
        return '/storage/' . $imagePath;
    }

     #A profile has many user followers.
     public function followers() 
     {
         return $this->belongsToMany(User::class);
     }

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}