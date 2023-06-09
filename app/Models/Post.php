<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = [
        'title',
        'description',
        'user_id',
        'slug',
        'image_path'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate'=> true
            ]
        ];
    }
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
