<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ProviderPayment extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $fillable = [
        'date',
        'amount',
        'payment_method',
        'note',
        'provider_id',
        'created_by_user_id',
        'last_updated_by_user_id',

        'created_at',
        'updated_at'
    ];
    protected $casts = [
        'shoppingsID' => 'array',
    ];
    protected static $logAttributes = ['*'];
}
