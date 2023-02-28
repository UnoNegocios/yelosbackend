<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use App\Models\Unit;
use App\Models\RawMaterial;
use App\Models\ShoppingDetail;
use App\Models\Shopping;
use App\Models\Inventory;

class Item extends Model
{
    //use \Staudenmeir\EloquentJsonRelations\HasJsonRelationships;
    use HasFactory;
    use LogsActivity;
    use \Znck\Eloquent\Traits\BelongsToThrough;
    
    protected $fillable = [
        'name',
        'sku',
        'macro',
        'is_published',
        'featured',
        'short_description',
        'description',
        'start_promo',
        'end_promo',
        'tax',
        'tax_type',
        'buy_when_available',
        'superiorID',
        'weight',
        //////////////
        'type',
        'provider_id',
        'unit_id',
        'cost',
        'weight',
        'longitude',
        'height',
        'width',
        'discoiunt_price',
        'price',
        'product_type',
        'created_by_user_id',

        'code_one',
        'code_two',
        'code_three',
        'price_one',
        'price_two',
        'price_three',
        'price_four',
        'sat_key_code',

        

        
        
    ];
    protected $casts = [
        'inventory' => 'array',
        'categories' => 'array',
        'images' => 'array',
        //'variations' => 'array',
        'ideal_inventory'  => 'array',
        'raw_materials' => 'array'
      ];

     //protected $appends = ['costo'];

      protected static $logAttributes = ['*'];

      public function unit()
      {
          return $this->belongsTo(Unit::class);
      }

      public function quotationItem()
      {
          return $this->belongsToMany(QuotationItem::class);
      }

      public function rawMaterialsRelation(){
        return $this->belongsToJson(RawMaterial::class, 'raw_materials[]->raw_material_id');
      }

      public function shoppingDetails(){
        return $this->hasMany(ShoppingDetail::class);
      }

      public function latestShoppingDetail(){
        return $this->hasMany(ShoppingDetail::class)->latest();
      }

      public function inventoryRecords(){
        return $this->hasMany(Inventory::class);
    }


      public function getCostoAttribute()
        {

            $data = $this->rawMaterialsRelation;
            $sum = 0;

            foreach($data as $key => $value){
                $sum = $sum + (($value->cost/100)*$value->pivot->percentage);
            };

            return $sum;
        }
}
