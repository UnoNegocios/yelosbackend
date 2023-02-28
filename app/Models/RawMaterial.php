<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Item;
use Spatie\Activitylog\Traits\LogsActivity;

class RawMaterial extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'name',
        'cost'     
    ];

    public function Item(){
        return $this->belongsTo(Item::class);
    }
}
