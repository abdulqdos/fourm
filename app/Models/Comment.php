<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    /** @use HasFactory<\Database\Factories\CommentFactory> */
    use HasFactory;

    protected $fillable = ['body' , 'user_id' , 'post_id'];
    public function user(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function post(): belongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
