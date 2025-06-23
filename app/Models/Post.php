<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{

    protected $table = 'posts';
    protected $guarded = [];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Post_Category::class, 'post_category_id');
    }

    public function files(): HasMany
    {
        return $this->hasMany(Post_File::class, 'post_id');
    }
}
