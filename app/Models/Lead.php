<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\ModelStatus\HasStatuses;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

use App\Models\Message;
use App\Models\Conversation;

class Lead extends Model
{
    use HasFactory;
    use LogsActivity;
    //use HasStatuses;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'name',
        'last',
        'phone',
        'email',
        'company',
        'job_position',
        'address',
        'status',
        'channel',
        'origin_id',
        'conversation_id',
        'funnel_phase_id',
        'user_id',
        'interest'
    ];

    protected $casts = [
        'additional_data' => 'json'
    ];

    protected static $logAttributes = ['*'];


    public function user(){
        return $this->belongsTo('\App\Models\User');
    }

    public function origin(){
        return $this->belongsTo('\App\Models\Origin');
    }

    public function conversation(){
        return $this->hasOne('\App\Models\Conversation');
    }

   public function messages(){
        return $this->hasManyThrough('\App\Models\Message', '\App\Models\Conversation');
    }

    public function funnelPhase(){
        return $this->belongsTo('\App\Models\FunnelPhase');
    }

    public function scopeCreatedBetween(Builder $query, $date, $date2): Builder
    {
    return $query->whereBetween('created_at', [Carbon::parse($date)->startOfDay(), Carbon::parse($date2)->endOfDay()]);
    }
    
}
