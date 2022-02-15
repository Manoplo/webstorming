<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * Model Post represents a post or "storming". A post has one creator, many comments and one stack. Also, a post is liked by many users. 
     * 
     */

    // Factory fillables

    protected $fillable = [
        'title',
        'body',
        'image',
        'stack_id',
        'user_id'
    ];


    public function creator()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function stack()
    {
        return $this->belongsTo(Stack::class);
    }
}
