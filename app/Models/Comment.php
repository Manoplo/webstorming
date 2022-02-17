<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{


    use HasFactory;

    protected $fillable = [
        'user_id',
        'post_id',
        'body'
    ];

    /**
     * Comment model represents a comment on a post. A comment belongs to one author and one post
     */

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
