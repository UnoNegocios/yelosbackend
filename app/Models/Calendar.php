<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\user\UserMinResource;

class Calendar extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
                'company_id',
                'contact_id',
                'activity_id',
                'date',
                'only_date',
                'only_time',
                'description',
                'completed',
                'user_id',
                'lead_id',

                /* NEURIK */

                'result',
                //'abrir venta',
                'created_by_user_id',
                'last_updated_by_user_id',
                'created_at',
                'updated_at'
                //'orden'(fecha)


    ];
    protected static $logFillable = true;

    public function user()
    {
        return $this->belongsToThrough(User::class, Company::class);
    }

    public function usuario(){
        return $this->belongsTo(User::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function contact()
    {
        return $this->belongsTo(Contact::class,);
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
    
    public function scopeDateBetween(Builder $query, $date, $date2): Builder
    {
        
    return $query->whereBetween('date', [Carbon::parse($date), Carbon::parse($date2)->endOfDay()]);

    }

    public function scopeCreatedBetween(Builder $query, $date, $date2): Builder
    {
        
    return $query->whereBetween('created_at', [Carbon::parse($date), Carbon::parse($date2)->endOfDay()]);

    }

    public function getLastUpdatedByUser()
    {
       return new UserMinResource(User::findOrFail($this->last_updated_by_user_id));
    }

    public function getCreatedByUser()
    {
       return new UserMinResource(User::findOrFail($this->created_by_user_id));
    }


}
