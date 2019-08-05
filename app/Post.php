<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    /**
     * Defines relation between single post and user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
