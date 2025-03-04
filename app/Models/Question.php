<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory;
    protected $table = 'questions';
    protected $guarded=[];

    public function from_color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'from_color_id');
    }

    public function to_color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'to_color_id');
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Question_Answer::class , 'question_id');
    }

    public function logs():HasMany
    {
        return $this->hasMany(Question_Log::class , 'question_id');
    }
}
