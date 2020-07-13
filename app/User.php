<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    # The boot method gets called when we are booting up the model.
    # Created event gets fired when a new user is created.
    protected static function boot()
    {
        parent::boot();
        static::created(
            function($user) {
                $user->profile()->create([
                    'title' => $user->username,
                ]);
            }
        );
    }

    #A user relates to many posts.
    public function posts() 
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    #A user relates to one profile.
    public function profile() 
    {
        return $this->hasOne(Profile::class);
    }

    #A user follows many profiles.
    public function following() 
    {
        return $this->belongsToMany(Profile::class);
    }


}
