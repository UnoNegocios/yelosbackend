<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunnelPhase extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'funnel_id',
        'time',
        'order',
        'days'  
    ];

    public function funnel(){
        return $this->belongsTo('\App\Models\Funnel');
    }
}
