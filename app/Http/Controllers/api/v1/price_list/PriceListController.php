<?php

namespace App\Http\Controllers\api\v1\price_list;

use App\Models\PriceList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PriceListController extends Controller
{
    public function index()
    {
        return PriceList::orderBy('updated_at', 'DESC')->get();
    }
    public function store(Request $request)
    {
        $price = new PriceList();
        $price->item = $request->item;       
        $price->save();
    }
    public function update(Request $request, PriceList $price)
    {
        $price = PriceList::findOrFail($request->id);
        $price->item = $request->item;
        $price->save();
        return $price;
    }
    public function destroy(Request $request)
    {
        $price = PriceList::destroy($request->id);
        return $price;
    }
}
