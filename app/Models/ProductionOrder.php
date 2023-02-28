<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductionOrder extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $fillable = [
        'item_id',
        'quantity',
        'created_by_user_id',
    ];
    protected static $logAttributes = ['*'];

}
