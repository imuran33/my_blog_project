<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;    //追記

class Post extends Model
{
    use SoftDeletes;    //追記

    protected $fillable = ['title', 'content', 'category'];    //追記
}
