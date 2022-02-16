<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stack extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
    ];

    /**
     * Model stack represents a frontend/backend stack with a relation of one to many with Post. 
     * Each post has one stack.
     */

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
