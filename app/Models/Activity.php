<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Calendar;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'color',
    ];

    public function calendars()
    {
        return $this->hasMany(Calendar::class);
    }
}
