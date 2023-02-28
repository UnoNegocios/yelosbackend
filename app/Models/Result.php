<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Result extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $fillable = [
        'date',
        'year',
        'month',
        'day',
        'accounts_receivable',
        'debts_to_pay',
        'inventory',
    ];
    protected static $logFillable = true;
}

