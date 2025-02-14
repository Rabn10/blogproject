<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\HasMany;

class post extends Model
{
    use HasFactory;

    public function likes() {
        return $this->hasMany(Like::class);
    }

    public function isLikedByUser($userId) {
        return $this->likes()->where('user_id', $userId)->exists();
    }
}
