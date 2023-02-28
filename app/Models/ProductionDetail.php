<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductionDetail extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'production_id',
        'item_id',
        'quantity',
        'created_by_user_id',
        'last_updated_by_user_id'
    ];
    protected $casts = [
        'insumos' => 'array',
        'salesID' => 'array', 
    ];
    protected static $logAttributes = ['*'];
}
