<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Color_Group extends Model
{
    use HasFactory;
    protected $table = 'color_groups';
    protected $guarded=[];

    public function colors():HasMany
    {
        return $this->hasMany(Color::class, 'color_group_id');
    }
}
