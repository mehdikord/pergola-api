<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Color extends Model
{
    use HasFactory;
    protected $table='colors';
    protected $guarded=[];

    public function group():belongsTo
    {
        return $this->belongsTo(Color_Group::class, 'color_group_id');
    }

    public function from_colors()
    {
        return $this->hasMany(Question::class, 'from_color_id');
    }

}
