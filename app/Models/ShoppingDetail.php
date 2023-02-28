<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Item;
use App\Models\Shopping;

class ShoppingDetail extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $fillable = [
        'shopping_id',
        'item_id',
        'quantity',
        'merma',
        'unit_cost',
        'used',
        'created_by_user_id',
        'last_updated_by_user_id',

        'created_at',
        'updated_at'
    ];
    protected $casts = [
    'productionsID' => 'array',
    'salesID' => 'array'
    ];
    protected static $logAttributes = ['*'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function shopping(){
        return $this->belongsTo(Shopping::class);
    }
}
