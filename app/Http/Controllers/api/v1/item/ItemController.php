<?php

namespace App\Http\Controllers\api\v1\item;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::orderBy('updated_at', 'DESC')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $item = new Item();     
        $item->name = $request->name;  
        $item->sku = $request->sku;  
        $item->macro = $request->macro;  
        $item->is_published = $request->is_published;  
        $item->featured = $request->featured;  
        $item->short_description = $request->short_description;  
        $item->description = $request->description;  
        $item->start_promo = $request->start_promo;  
        $item->end_promo = $request->end_promo;  
        $item->tax = $request->tax;  
        $item->tax_type = $request->natax_typeme;  
        $item->buy_when_available = $request->buy_when_available;  
        $item->superiorID = $request->superiorID;  
        $item->inventory = $request->inventory;  
        $item->weight = $request->weight;  
        $item->longitude = $request->longitude;  
        $item->heihgt = $request->heihgt;  
        $item->discoiunt_price = $request->discoiunt_price;  
        $item->price = $request->price;
        $item->product_type = $request->product_type;
        $item->categories = $request->categories;  
        $item->images = $request->images;  
        $item->type = $request->type;  
        $item->provider_id = $request->provider_id;  
        $item->unit_id = $request->unit_id;  
        $item->cost = $request->cost;
        $item->created_by_user_id = $request->created_by_user_id;
        $item->ideal_inventory = $request->ideal_inventory;
        $item->raw_materials = $request->raw_materials;

        $item->code_one = $request->code_one;
        $item->code_two = $request->code_two;
        $item->code_three = $request->code_three;
        $item->price_one = $request->price_one;
        $item->price_two = $request->price_two;
        $item->price_three = $request->price_three;
        $item->price_four = $request->price_four;
        $item->sat_key_code = $request->sat_key_code;

        $item->save();

        

        return $item;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item = Item::findOrFail($request->id);
        $item->name = $request->name;  
        $item->sku = $request->sku;  
        $item->macro = $request->macro;  
        $item->is_published = $request->is_published;  
        $item->featured = $request->featured;  
        $item->short_description = $request->short_description;  
        $item->description = $request->description;  
        $item->start_promo = $request->start_promo;  
        $item->end_promo = $request->end_promo;  
        $item->tax = $request->tax;  
        $item->tax_type = $request->natax_typeme;  
        $item->buy_when_available = $request->buy_when_available;  
        $item->superiorID = $request->superiorID;  
        $item->inventory = $request->inventory;  
        $item->weight = $request->weight;  
        $item->longitude = $request->longitude;
        $item->heihgt = $request->heihgt;  
        $item->discoiunt_price = $request->discoiunt_price;  
        $item->price = $request->price;
        $item->product_type = $request->product_type;
        $item->categories = $request->categories;  
        $item->images = $request->images;  
        $item->type = $request->type;  
        $item->provider_id = $request->provider_id;  
        $item->unit_id = $request->unit_id;  
        $item->cost = $request->cost;
        $item->created_by_user_id = $request->created_by_user_id;
        $item->ideal_inventory = $request->ideal_inventory;
        $item->raw_materials = $request->raw_materials;

        $item->code_one = $request->code_one;
        $item->code_two = $request->code_two;
        $item->code_three = $request->code_three;
        $item->price_one = $request->price_one;
        $item->price_two = $request->price_two;
        $item->price_three = $request->price_three;
        $item->price_four = $request->price_four;
        $item->sat_key_code = $request->sat_key_code;
        
        $item->save();
        return $item;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $item = Item::destroy($request->id);
        return $item;
    }
    
 public function files(Request $request){
        $fileName = 'UNOCRM_' . Carbon::now() . '_' . $request->file->getClientOriginalName();
        $request->file->move(public_path('../public/files/items'), $fileName);
        return response()->json(['file' => $fileName]);
    }  

    public function bulkUpdate(Request $request) {
        $data = $request->all();

        foreach ($data as $key => $value) {
      
         $perro = Item::findOrFail($value['id'])
         ->update([
          'cost' => $value['cost'],
         ]);
      

           };

        }

        public function bulkPatch(Request $request) {
            $data = $request->all();
    
            foreach ($data as $key => $value) {
          
             $perro = Item::findOrFail($value['id'])
             ->update([
              'raw_materials' => $value['raw_materials'],
             ]);
          
    
               };
    
            }
}
