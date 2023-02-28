<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\User;
use App\Models\Contact;
use App\Models\Calendar;
use App\Models\Quotation;
use App\Models\Category;
use Illuminate\Support\Carbon;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;



class Company extends Model
{
    use HasFactory;
    use LogsActivity;
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'email',
        'rfc',
        'cfdi_id',
        'razon_social',
        'special_note',
        'phase_id',
        'origin_id',
        'user_id',
        'status_id',
        'delivery_address',
        'credit_days',
        'credit_limit',
        'bank_account_number',
        'delivery_time',
        'address_references',
        'activity_indicator',

        /* NEURIK */

        'number',//kha
        'opportunity_area',//kha
        'payment_conditions',//kha
        'type_id',//kha
        'zone_id',//kha
        'contact_mode_id',//kha
        'payment_method_id',//kha
        'frequency_id',//kha
        'price_list_id',//kha
        
        'created_by_user_id',//kha

        'created_at',
        'updated_at'


    ];
    protected $casts = [
        'consumptions' => 'array',//kha
        'special_conditions' => 'array',//kha
    ];
    protected static $logAttributes = ['*'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function contacts(){
        return $this->hasMany(Contact::class);
    }

    public function calendars(){
        return $this->hasMany(Calendar::class)->orderBy('date', 'DESC');
    }

    public function quotations(){
        return $this->hasMany(Quotation::class);
    }

    public function cfdi()
    {
        return $this->belongsTo('\App\Models\Cfdi');
    }
    public function phase()
    {
        return $this->belongsTo('\App\Models\Phase');
    }
    public function origin()
    {
        return $this->belongsTo('\App\Models\Origin');
    }
    public function status()
    {
        return $this->belongsTo('\App\Models\Status');
    }
    public function type()
    {
        return $this->belongsTo('\App\Models\Type');
    }
    public function zone()
    {
        return $this->belongsTo('\App\Models\Zone');
    }
    public function contactMode()
    {
        return $this->belongsTo('\App\Models\ContactMode');
    }
    public function paymentMethod()
    {
        return $this->belongsTo('\App\Models\Payment_method');
    }
    public function frequency()
    {
        return $this->belongsTo('\App\Models\Frequency');
    }
    public function priceList()
    {
        return $this->belongsTo('\App\Models\PriceList');
    }

    public function consumptions(){
        return $this->belongsToJson(Category::class, 'consumptions');
    }

    public function scopeCreatedBetween(Builder $query, $date, $date2): Builder
    {

    return $query->whereBetween('created_at', [Carbon::parse($date), Carbon::parse($date2)->endOfDay()]);

    }

    public function scopeUpdateddBetween(Builder $query, $date, $date2): Builder
    {
        
    return $query->whereBetween('updated_at', [Carbon::parse($date), Carbon::parse($date2)->endOfDay()]);

    }

    public function getActivityIndicator(){

          if(Carbon::parse($this->calendars->first()->date)->startOfDay() > Carbon::now()->endOfDay() && $this->calendars->first()->completed != true){
                return 'green';
            }
            else if(Carbon::parse($this->calendars->first()->date)->startOfDay() == Carbon::now()->startOfDay() && $this->calendars->first()->completed != true){
                return 'yellow';
            }
            else{
                return 'red';
            }
    }
}
