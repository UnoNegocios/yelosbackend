<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;


class Payroll extends Model
{
    use HasFactory;
    use LogsActivity;
    
    protected $fillable = [ 
        'date',
        'user_id',
        'imss',
        'infonavit',
        'amount',
        'extra_time',
        'production_award',
        'punctuality_award',
        'performance_award',
        'absence',
        'notes',
        'created_by_user_id',
        'last_updated_by_user_id',
        'loan',
        'holidays',
        'prima_vacacional',

        'created_at',
        'updated_at'



    ];
    protected static $logFillable = true;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeDateBetween(Builder $query, $date, $date2): Builder
    {
        
    return $query->whereBetween('date', [$date, $date2]);

    }

    public function scopeCreatedBetween(Builder $query, $date, $date2): Builder
    {

    return $query->whereBetween('created_at', [Carbon::parse($date), Carbon::parse($date2)->endOfDay()]);

    }

    public function scopeUpdatedBetween(Builder $query, $date, $date2): Builder
    {
        
    return $query->whereBetween('updated_at', [Carbon::parse($date), Carbon::parse($date2)->endOfDay()]);

    }
}
