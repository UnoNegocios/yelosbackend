<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Note extends Model
{
    use HasFactory;
    use LogsActivity;
    
    protected $fillable = [
        'comment',
        'seen',
        'from_user_id',
        'to_user_id',
        'company_id',
        'contact_id',
        
    ];
    protected static $logFillable = true;
}
