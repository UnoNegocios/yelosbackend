<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Adjustment extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'item_id',
        'date',
        'amount',
        'note',
        'created_by_user_id'
    ];
    protected static $logFillable = true;
}