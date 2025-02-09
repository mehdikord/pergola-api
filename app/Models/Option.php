<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Option extends Model
{
    use HasFactory;
    protected $table = 'options';
    protected $guarded=[];

    public function items(): HasMany
    {
        return $this->hasMany(Option_Item::class, 'option_id');
    }
}
