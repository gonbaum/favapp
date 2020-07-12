<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = []; #be careful with overriding the guarded method without specifying field types and names to be passed in the controller

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
