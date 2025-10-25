<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'content'
    ];
    public function authorUser()
    {
        return $this->belongsTo(User::class, 'author'); // 'author' column stores user ID
    }
}
