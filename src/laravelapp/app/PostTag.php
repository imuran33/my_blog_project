<?php

// app/Models/PostTag.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    protected $table = 'post_tag'; // 中間テーブルを明示的に指定

    public $timestamps = false; // タイムスタンプなし
}