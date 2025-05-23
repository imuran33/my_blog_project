<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;    //追記

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'content', 'category'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag');
    }

    public function favoriteUsers()
    {
        return $this->belongsToMany(User::class, 'favorites', 'post_id', 'user_id')->withTimestamps();
    }
}
