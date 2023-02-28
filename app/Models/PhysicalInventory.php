<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class PhysicalInventory extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $fillable = [
        'inventory',
        'authorization',
        'created_by_user_id',
        'updated_by_user_id'
    ];
    protected static $logFillable = true;
}
