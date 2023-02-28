<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;


class Inventory extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $fillable = [ 
        'item_id',
        'type',
        'quantity',
        'inventory',
        'created_by_user_id',
        'shopping_id',
        'production_id',
        'sale_id',

    ];
    protected static $logFillable = true;
}
