<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Payment_method;
use App\Models\Quotation;
use App\Models\CollectionDetail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use App\Http\Resources\payment_method\PaymentMethodResource;
use App\Http\Resources\user\UserMinResource;

class Collection extends Model
{
    use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    use \Znck\Eloquent\Traits\BelongsToThrough;
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'macro',
        'date',
        'payment_method_id',
        'amount',
        'invoice',
        'note',
        'pdf',
        'created_by_user_id',
        'last_updated_by_user_id',
        'user_id',
        'company_id',
        'remission',
        'methods',
        'serie',
        'payment_complement',

        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'salesID' => 'array',
        'methods' => 'array'
    ];
    protected static $logFillable = true;

    public function paymentMethod(){
        return $this->belongsTo(Payment_method::class);
    }

    

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function collectionDetails()
    {
        return $this->hasMany(CollectionDetail::class);
    }

    public function sales()
    {
        return $this->belongsToThrough(
            Quotation::class,
            CollectionDetail::class,
            null,
            '',
            [Quotation::class => 'sale_id']
        );
    }

    public function scopeDateBetween(Builder $query, $date, $date2): Builder
    {
        
    return $query->whereBetween('date', [Carbon::parse($date)->startOfDay(), Carbon::parse($date2)->endOfDay()]);

    }

    public function getCollectionPayments(){
        $data = $this->methods;
        if($data != null){
            foreach($data as $key => $value){
            $data[$key]['method'] = new PaymentMethodResource(Payment_method::findOrFail($value['method']));
            $data[$key]['amount'] = $value['amount'];
        }
    }
        return $data;
    }

    public function getLastUpdatedByUser()
    {
       return new UserMinResource(User::findOrFail($this->last_updated_by_user_id));
    }

    public function getCreatedByUser()
    {
       return new UserMinResource(User::findOrFail($this->created_by_user_id));
    }

    public function scopepayment(Builder $query, $date): Builder
{
    return $query->where('id', '=', 2);
}

}
