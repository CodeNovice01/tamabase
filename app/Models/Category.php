<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // title と body を一括代入できるようにするよ
    protected $fillable = ['title', 'body'];
    
}
