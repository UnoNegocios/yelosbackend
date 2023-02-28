<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Expense extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'concept',
        'type',
        'provider_id',
        'serie',
        'payment_method_id',
        'amount',
        'date',
        'invoice',
        'due_date',
        'payment_date',
        'paid',
        'notes',
        'pdf',
        'created_by_user_id',
        'last_updated_by_user_id',

        'created_at',
        'updated_at'
    ];
    protected static $logAttributes = ['*'];


    public function scopeDateBetween(Builder $query, $date, $date2): Builder {
    return $query->whereBetween('date', [$date, $date2]);
    }

    public function scopeCreatedBetween(Builder $query, $date, $date2): Builder {
    return $query->whereBetween('created_at', [Carbon::parse($date), Carbon::parse($date2)->endOfDay()]);
    }

    public function scopeUpdatedBetween(Builder $query, $date, $date2): Builder {
    return $query->whereBetween('updated_at', [Carbon::parse($date), Carbon::parse($date2)->endOfDay()]);
    }

    public function provider(){
        return $this->belongsTo(Provider::class);
    }

}
