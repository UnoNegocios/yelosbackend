<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Special_condition extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'condition',
    ];
}
