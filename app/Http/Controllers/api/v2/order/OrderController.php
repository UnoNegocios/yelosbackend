<?php

namespace App\Http\Controllers\api\v2\order;

use Illuminate\Http\Request;
use App\Models\Quotation;
use App\Http\Controllers\Controller;
use App\Http\Resources\user\UserResource;
use App\Http\Requests\user\StoreUserRequest;
use App\Http\Requests\user\UpdateUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Filters\OrdersToDispatchFilter;
use App\Http\Filters\DispatchedOrdersFilter;
use App\Actions\Orders\DispatchQuotationAction;
use App\Actions\Orders\StartOrderProductionAction;
use App\Events\OrderInProduction;
use App\Events\OrderToFillCreated;
use App\Events\OrderDispatched;
use App\Http\Resources\order\DispatchedSaleOrdersListResource;

class OrderController extends Controller
{
    /**
     * Display all orders to Dispatch using a filter.
     *
     * @return \Illuminate\Http\Response
     */
    
     public function ordersToDispatch(Request $request)
     {
        return OrdersToDispatchFilter::excecute($request);
     }


    
     
     public function dispatchedOrders(Request $request)
     {
      /**
     * Display all dispatched orders using a filter.
     * Allowed parameters [id, company_id, created_by_user_id, last_updated_by_user_id, note
     * date_between, created_between, updated_between
     * 
     */
        return DispatchedOrdersFilter::excecute($request);
     }



     public function startOrderProduction(Request $request, StartOrderProductionAction $startOrderProductionAction){
      /**
     * 
     * Start production in given sale, this disables changing the date of the sale and sends the id via websockets to the frontend.
     * 
     */
      $startOrderProductionAction->excecute($request);
      OrderInProduction::dispatch($request->id); //broadcasts the sale order that started production
      return response(null, 202);
     }



     public function dispatchSaleOrder(Request $request, DispatchQuotationAction $dispatchQuotationAction){
      /**
     * Display all dispatched orders using a filter.
     * Allowed parameters [id, company_id, created_by_user_id, last_updated_by_user_id, note
     * date_between, created_between, updated_between
     * 
     */
      $dispatchQuotationAction->excecute($request);
      $sale = Quotation::findOrFail($request->id);
      OrderDispatched::dispatch($request->id);
      return response(null, 202);
     }

     public function dispatchedSaleOrdersList()
     {
      $orders = Quotation::where('status', 'vendido')
      ->where('bar', '!=', true)
      ->orWhereNull('bar')
      ->doesntHave('shippingDetail')
      ->get();
      return DispatchedSaleOrdersListResource::collection($orders);
     }
}
