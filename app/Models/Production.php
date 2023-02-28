<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Production extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'date',
        'created_by_user_id',
        'updated_by_user_id',
        'user_id',
        'status',
        'start_time',
        'end_time',
    ];
    protected static $logFillable = true;

    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }
}
