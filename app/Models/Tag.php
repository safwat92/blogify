<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'article_id',
        'tag'
    ];

    public function articles() {
        return $this->belongsToMany(Article::class);
    }
}
