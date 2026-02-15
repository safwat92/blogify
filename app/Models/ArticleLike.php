<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleLike extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'article_id',
    ];

    public function article() {
        $this->belongsTo(Article::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
