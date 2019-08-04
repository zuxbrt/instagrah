<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /**
     * Fetching user class to profile.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
