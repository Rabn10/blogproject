<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CommentLike extends Model
{
    use HasFactory;

    protected $table = 'comment_like';

    protected $fillable = [
        'comment_id',
        'user_id'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function Comment() {
        return $this->belongsTo(Comment::class);
    }

}
