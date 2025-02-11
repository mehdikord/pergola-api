<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Plan extends Model
{
    use HasFactory;
    protected $table='plans';
    protected $guarded=[];

    public function users(): HasMany
    {
        return $this->hasMany(User_Plan::class, 'plan_id');
    }
}
