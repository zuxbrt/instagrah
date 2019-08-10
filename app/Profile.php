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
        $imagePath = ($this->image) ? $this->image : 'profile/1pgQC9QSzzXGcm17PBkp1CXLMJNVPZYvENDULk8H.png';
        return '/storage/' . $imagePath;
    }

    /**
     * Fetching user class to profile.
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
}
