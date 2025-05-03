<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    // title と body を一括代入できるようにするよ
    protected $fillable = ['title', 'body'];
}
