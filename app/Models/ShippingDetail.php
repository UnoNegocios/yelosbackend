<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Shipping;
use App\Models\Item;

class ShippingDetail extends Model
{
    use HasFactory;
    use LogsActivity;

    protected $fillable = [
        'sale_id',
        'shipping_id',
        'completed',
        'invoice',
        'pdf',
        'company_id',
        'created_by_user_id',
        'last_updated_by_user_id',

        'created_at',
        'updated_at'
    ];
    protected static $logFillable = true;

    public function shipping()
    {
      return $this->belongsTo(Shipping::class);
    }

    public function sale()
    {
      return $this->belongsTo(Quotation::class, 'sale_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function company(){
      return $this->belongsTo(Company::class);
    }


}
