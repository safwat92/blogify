<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'body',
        'cover_image',
        'views_count',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bookmarkedBy()
    {
        return $this->belongsToMany(User::class, "bookmarks");
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function article_likes()
    {
        return $this->hasMany(ArticleLike::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
