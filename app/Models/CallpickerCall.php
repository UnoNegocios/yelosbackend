<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CallpickerCall extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'call_type',
        'call_status',
        'date',
        'caller_id',
        'duration',
        'callpicker_number',
        'dialed_number',
        'answered_by',
        'dialed_by',
        'records',
        'city',
        'state',
        'record_keys',
        'note'
    ];
}
