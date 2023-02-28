<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\ShippingDetail;

use App\Models\Vehicle;
use App\Models\User;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

use App\Models\Quotation;
use App\Models\QuotationItem;

class Shipping extends Model
{
    use \Staudenmeir\EloquentHasManyDeep\HasRelationships;

    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'driver_id',
        'date',
        'vehicle_id',
        'initial_km',
        'final_km',
        'note',
        'created_by_user_id',
        'last_updated_by_user_id',
    ];
    protected static $logFillable = true;
    
    public function shippingDetail()
    {
      return $this->hasMany(ShippingDetail::class);
    }

    public function vehicle(){
      return $this->belongsTo(Vehicle::class);
    }

    public function driver(){
      return $this->belongsTo(User::class);
    }

    public function scopeDateBetween(Builder $query, $date, $date2): Builder
    {
    return $query->whereBetween('date', [Carbon::parse($date), Carbon::parse($date2)->endOfDay()]);
    }

    public function scopeCreatedBetween(Builder $query, $date, $date2): Builder
    {
    return $query->whereBetween('created_at', [Carbon::parse($date), Carbon::parse($date2)->endOfDay()]);
    }

    public function scopeUpdateddBetween(Builder $query, $date, $date2): Builder
    {     
    return $query->whereBetween('updated_at', [Carbon::parse($date), Carbon::parse($date2)->endOfDay()]);
    }

    public function venga(){
      return $this->hasManyDeep(QuotationItem::class, 
      [ShippingDetail::class, Quotation::class],
      ['sale_id'],
      ['id']
      
    );
    }


    

}
