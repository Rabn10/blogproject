<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CommentLike;
use App\Models\Reply;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Comment extends Model
{
    use HasFactory;

    public function likes() {
        return $this->hasMany(CommentLike::class);
    }

    public function isCommentLikedByUser($userId) {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function replies() {
        return $this->hasMany(Reply::class);
    }
}
