<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Provider;
use App\Models\ShoppingDetail;
use App\Http\Resources\user\UserLightResource;
use EloquentFilter\Filterable;


class Shopping extends Model
{
    use HasFactory;
    use LogsActivity;
    use Filterable;
    protected $fillable = [
        'date',
        'serie',
        'provider_id',
        'invoice',
        'due_date',
        'notes',
        'pdf',
        'xml',
        'iva_percentage',
        'isr_percentage',
        'created_by_user_id',
        'last_updated_by_user_id',
        'received',

        'created_at',
        'updated_at'



    ];
    protected static $logAttributes = ['*'];
    //protected $appends = ['perro'];

    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\ShoppingFilter::class);
    }

    public function provider(){
        return $this->belongsTo(Provider::class);
    }

    public function shoppingDetail(){
        return $this->hasMany(ShoppingDetail::class);
    }

    public function getLastUpdatedByUser()
    {
       return new UserLightResource(User::findOrFail($this->last_updated_by_user_id));
    }

    public function getCreatedByUser()
    {
       return new UserLightResource(User::findOrFail($this->created_by_user_id));
    }

    public function getPerroAttribute()
    {
        if($this->serie === 'Serie A'){
            return 'pagado';
        }
        else{
            return 'no pagado';
        }
    }

    public function scopeDateBetween(Builder $query, $date, $date2): Builder
    {
    return $query->whereBetween('date', [Carbon::parse($date), Carbon::parse($date2)->endOfDay()]);
    }

    public function scopeDueBetween(Builder $query, $date, $date2): Builder
    {
    return $query->whereBetween('due_date', [Carbon::parse($date), Carbon::parse($date2)->endOfDay()]);
    }

    public function scopeCreatedBetween(Builder $query, $date, $date2): Builder
    {
    return $query->whereBetween('created_at', [Carbon::parse($date), Carbon::parse($date2)->endOfDay()]);
    }

    public function scopeUpdateddBetween(Builder $query, $date, $date2): Builder
    { 
    return $query->whereBetween('updated_at', [Carbon::parse($date), Carbon::parse($date2)->endOfDay()]);
    }

}
