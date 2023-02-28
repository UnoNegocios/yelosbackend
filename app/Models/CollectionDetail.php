<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Collection;

class CollectionDetail extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'amount',
        'due',
        'new_due',
        'collection_id',
        'sale_id',
        'created_at',
        'updated_at',
    ];

    public function collection()
    {
        return $this->belongsTo(Collection::class);
    }
    public function sale()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function company()
    {
        return $this->belongsToThrough(Company::class, Collection::class);
    }

    public function scopeDateBetween(Builder $query, $date, $date2): Builder
    {
        
    return $query->whereBetween('date', [Carbon::parse($date), Carbon::parse($date2)->endOfDay()]);

    }


}

