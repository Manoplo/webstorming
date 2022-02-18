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
        'description',
        'type',
        'stack_id',
        'user_id'
    ];


    public function user()
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

    /**
     * A post can be liked by many users.
     *
     * @return relation to the user model in the posts_users table
     */
    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_users');
    }
}
