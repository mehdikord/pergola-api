<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer_Option extends Model
{
    use HasFactory;
    protected $table = 'answer_options';
    protected $guarded=[];
}
