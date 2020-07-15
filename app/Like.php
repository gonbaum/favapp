<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{   
    # Be careful of not overriding the guarded method without specifying validation rules for data passed through the controller
    protected $guarded = []; 
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
