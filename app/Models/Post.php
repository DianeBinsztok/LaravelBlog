<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    use HasFactory;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    //check : Eloquent ORM > aggregating related models > Counting Related Models
    public function nbOfComments(): int
    {
        return count($this->comments);
    }
}
