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
        'name', 'email','username', 'password'
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

    /**
     * Called when loaded up model.
     */
    protected static function boot()
    {
        parent::boot();

        // on user creation
        static::created(function ($user) {
            $user->profile()->create([
                'title' => $user->username
            ]);
        });


    }

    /**
     * Relation between single user and multiple posts.
     */
    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    /**
     * Relation between following profiles.
     */
    public function following()
    {
        return $this->belongsToMany(Profile::class);
    }

    /**
     * Relation between user and its profile.
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }
}
