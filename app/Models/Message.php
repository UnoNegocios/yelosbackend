<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'uuid',
        'conversation_id',
        'user_id',
        'from',
        'to',
        'direction',
        'channel',
        'name',
        'zenvia_timestamp'
    ];
    protected $casts = [
        'contents' => 'json',
    ];
    protected $primaryKey = 'uuid';

    public function messageStatuses(){
        return $this->hasMany(MessageStatus::class, 'message_id');
    }

    public function conversation(){
        return $this->belongsTo(Conversation::class);
    }

    public function lead(){
        return $this->BelongsToThrough(Lead::class, Conversation::class);
    }
}