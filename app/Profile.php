<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // disabling mass assignment
    protected $guarded = [];

    /**
     * Fetching user class to profile.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
