<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Message;


class MessageStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'message_id',
        'code',
        'zenvia_timestamp'
    ];

    public function message(){
        return $this->belongsTo(Message::class, 'message_id');
    }
}
