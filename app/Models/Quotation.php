<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\QuotationItem;
use App\Models\User;
use App\Models\Contact;
use App\Models\Item;
use App\Models\PriceList;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use App\Models\CollectionDetial;
use App\Models\ShippingDetail;
use Illuminate\Support\Facades\Log;
use App\Http\Resources\user\UserMinResource;
use App\Models\Payment_method;
use App\Http\Resources\sale\SaleCollectionDatesResource;

class Quotation extends Model
{
    use HasFactory;
    use LogsActivity;
    protected $fillable = [
        'company_id',
        'user_id',
        'subtotal',
        'pdf',
        'note',
        'contact_id',
        'rejection_id',
        'rejection_comment',
        'status',
        'invoice_date',
        'due_date',
        'production_dispatched',
        'payment_status',

        /* NEURIK */
        'date',
        'bar',
        'type',
        'iva',
        'total',
        'invoice',
        'printed',
        'created_by_user_id',
        'last_updated_by_user_id',
        'is_in_production'
        
    ];
    protected $casts = [
        'items' => 'array',//detalle
        /* {
            'quotation_id',
            'product_id',
            'quantity',
            'list_pice',
            'adjusted_price',
            'weight'
        } */
    ];

    protected $appends = ['num_days_past_due', 'salesman'];
    protected $hidden = ['company'];

    protected static $logAttributes = ['*'];

    public function quotationItems()
    {
        return $this->hasMany(QuotationItem::class, 'quotation_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function collections()
    {
        return $this->hasManyThrough(Collection::class, Company::class);
    }

    /*public function collectionAmount(){
        return $this->hasManyJson(Collection::class, 'salesID[]->id');
    }*/

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

    public function collectionDetails()
    {
        return $this->hasMany(CollectionDetail::class, 'sale_id');
    }

    public function shippingDetail()
    {
        return $this->hasOne(ShippingDetail::class, 'sale_id');
    }

    public function priceList()
    {
        return $this->belongsTo(PriceList::class);
    }

    public function getDueBalance(): float
    {
       return ($this->getSaleTotal()) - ($this->collectionDetails->sum('amount'));
    }

    public function getDaysPastDue(): int
    {
        return (double)date_diff(Carbon::parse($this->date),now())->format('%R%a');
    }

    public function getBalanceDueDays(): int
    {
        return (double)date_diff(Carbon::parse($this->date)->addDays($this->company->credit_days), now())->format('%R%a');
    }

    public function getDaysSinceSale(){
        return date_diff(now()->endOfDay(), Carbon::parse($this->date)->endOfDay())->format('%R%a');
    }

    public function getPaymentStatus(): string
    {
        if($this->getDueBalance()<1){
            return 'Cobrada';
        }
        else if($this->company->credit_days){
            if($this->getBalanceDueDays()>0){
                return 'Vencida';
            }else{
                return 'En Crédito';
            }
        }else{
            return 'En Proceso';
        }
        /*
        else if($this->type=='Serie A'){
            return 'En Credito';
        }
        else if($this->type=='Serie B'){
            return 'Por Cobrar';
        }
        */
    }

    public function getSaleTotalWeight()
    {
        $items = $this->quotationItems; 
        $sum = 0;
        foreach($items as $key => $value) {
            $sum = $sum + ((Item::findOrFail($value->item_id)->weight)*($value->quantity));
        }
        return $sum;
    }

    public function getCompletedShipping(){
        if($this->shippingDetail != null){
            return $this->shippingDetail->completed;
        }else{
            return false;
        }
    }

    public function getShippingDate(){
        if($this->shippingDetail != null){
            return $this->shippingDetail->shipping->date;
        }else{
            return false;
        }
    }

    public function getUtility(){
        $sum = 0;
        foreach($this->quotationItems as $key => $value)
        {
           $sum = $sum + (($value->price*$value->quantity) - ($value->cost*$value->quantity));
        }
        return $sum;
    }

    public function getKilogramsSold(){
        $sum = 0;
        foreach($this->quotationItems as $key => $value)
        {
           $sum = $sum + (($value->price*$value->quantity) - ($value->cost*$value->quantity));
        }
        return $sum;
    }

    public function saleInvoice(){
        if($this->type == 'Serie A'){
            return $this->invoice;
        }else{
            return null;
        }
    }

    public function saleRemission(){
        if($this->type == 'Serie B'){
            return $this->invoice;
        }else{
            return null;
        }
    }



    public function scopeVendedor(Builder $query, $vendedor, $nada): Builder
    {
        foreach($query as $key => $value) {
            Log::debug($value);
        }
        Log::debug($query);
        return $query;
    }

    public function getLastUpdatedByUser()
    {
       return new UserMinResource(User::findOrFail($this->last_updated_by_user_id));
    }

    public function getCreatedByUser()
    {
       return new UserMinResource(User::findOrFail($this->last_updated_by_user_id));
    }

    public function getNumDaysPastDueAttribute(){
        return (double)date_diff(Carbon::parse($this->date),now())->format('%R%a');
    }

    public function getSalesmanAttribute()
    {
        return $this->company->user_id;
    }

    public function getSaleTotal()
    {
        if($this->type == 'Serie A'){
            return $this->getSaleSubtotal()*1.16;
        }
        else if($this->type == 'Serie B'){
            if($this->created_at > '2022-06-28 00:00:00'){
                return $this->getSaleSubtotal()*1.16;
            }else{
                return $this->getSaleSubtotal()*1.08;
            }
        }
    }
    public function getSaleIva()
    {
        if($this->type == 'Serie A'){
            return $this->getSaleSubtotal()*.16;
        }
        else if($this->type == 'Serie B'){
            if($this->created_at > '2022-06-28 00:00:00'){
                return $this->getSaleSubtotal()*.16;
            }else{
                return $this->getSaleSubtotal()*.08;
            }
        }
    }

    public function getPastDueBalance()
    {
        if($this->getDaysPastDue() > $this->company->credit_days){
            return $this->getSaleTotal() - $this->collectionDetails->sum('amount');
        }else{
            return 0;
        }
    }
    public function getSaleSubtotal(){
        $sum = 0;

        foreach ($this->quotationItems as $key => $value){
            $sum = $sum + ($value->quantity * $value->price);
        }
        return $sum;
    }

    public function colletionDetailsChenchuya(){
        return $this->hasMany(CollectionDetail::class, 'sale_id');
    }

    public function paymentMethod(){
       return $this->belongsTo(Payment_method::class);
    }

    public function collectionDates(){
        if(count($this->collectionDetails)){
        return SaleCollectionDatesResource::collection($this->collectionDetails);
        }else {
            return null;
        }
    }
        
}
