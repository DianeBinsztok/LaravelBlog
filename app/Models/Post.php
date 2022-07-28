<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $perPage = 10;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use HasFactory;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
