<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Profile;

class PostComment extends Model
{
    protected $table = 'posts_comments';

    /**
     * Define relationship with post.
     */
    public function post(){
        return $this->belongsTo(Post::class);
    }

    /**
     * Comment user.
     */
    public function user()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Get profile image for the user's comment.
     * @param $user_id
     */
    public function userImage($user_id)
    {
        $profile = Profile::find($user_id);
        return ($profile->image) ? '/storage/'.$profile->image : 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSPoiOPl_l2kX5BZsLACATzipLjD92P6m7t7ZmZzwJ-g_47dIGF';
    }

    public function formatDate($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('H:i');
    }
}
