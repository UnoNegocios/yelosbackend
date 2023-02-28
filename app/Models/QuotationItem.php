<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use \App\Models\Item;

class QuotationItem extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $fillable =[
        'quotation_id',
        'quantity',
        'item_id',    
        'value',    //precio al dia catalogo
        'price',    // precio ajustado
        'cost',     //costo al dia catalogo
        'merma',
        'rejection_status',
        'created_at',
        'updated_at',
       //'total'
    ];
    protected static $logAttributes = ['*'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function scopeDateBetween(Builder $query, $date, $date2): Builder
    {
        
    return $query->whereBetween('created_at', [Carbon::parse($date), Carbon::parse($date2)]);
    }

}
