<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User_Question extends Model
{
    use HasFactory;
    protected $table='user_questions';
    protected $guarded=[];

    public function from_color() :BelongsTo
    {
        return $this->belongsTo(Color::class, 'from_color_id');
    }
    public function to_color() :BelongsTo
    {
        return $this->belongsTo(Color::class, 'to_color_id');
    }

}
