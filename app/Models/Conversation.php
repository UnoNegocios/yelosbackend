<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_picture',
        'client_name',
        'company_id',
        'channel',
        'channelId',
        'lead_id',
        'first_name',
        'last_name',
    ];


    public function messages()
    {
        return $this->hasMany('\App\Models\Message');
    }

    public function client()
    {
        return $this->belongsTo('\App\Models\Client');
    }

}