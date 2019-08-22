<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    // disabling mass assignment
    protected $guarded = [];

    /**
     * Return profile image url on user's post. (placeholder for no image)
     */
    public function profileImage()
    {
        $imagePath = ($this->image) ? '/storage/'.$this->image : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSPoiOPl_l2kX5BZsLACATzipLjD92P6m7t7ZmZzwJ-g_47dIGF';
        return $imagePath;
    }

    /**
     * Profile followers.
     */
    public function followers()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Fetching user class to profile.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
