<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post_Category extends Model
{
    protected $table = 'post_categories';
    protected $guarded = [];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'post_category_id');
    }

}
