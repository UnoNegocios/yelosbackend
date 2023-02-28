<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\api\v1\LoginController;
use App\Models\Lead;
use App\Models\CollectionDetail;
use App\Models\Collection;
use App\Models\Quotation;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Http\Resources\quotation\QuotationResource;
use App\Http\Resources\conversation\ConversationMinResource;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Carbon;
use App\Actions\Sales\SaleAdditionalValues;
use App\Models\Company;
use App\Models\Item;
use App\Models\Sale;
use App\Models\ShippingDetail;
use App\Models\ShoppingDetail;
use App\Models\Shipping;
use App\Http\Resources\item\ItemPosResource;
use App\Models\QuotationItem;

Route::get('/pez', function (Request $request) {

    $sales = Quotation::where('status', 'vendido')
    ->where('date', '>=', '2022-01-01')
    ->where('payment_status', 'Vencida')
    ->where('production_dispatched', 1)
    ->get();

    $quotationsArray = [];

    foreach($sales as $sale) {

        $collections = $sale->collectionDetails->sum('amount');
        $expiration_days = (double)date_diff(Carbon::parse($sale->date)->addDays($sale->company->credit_days), now())->format('%R%a');

        $modifiedData["company"] = $sale->company;
        $modifiedData["expiration_days"] = $expiration_days;
        $modifiedData["total"] = $sale->total - $collections;
        $modifiedData["salesman"] = $sale->company->user;

        $quotationsArray[] = $modifiedData;

    }

    $collectiox = collect($quotationsArray);

    return response()->json($quotationsArray);

});

Route::get('/pato', function (Request $request) {

    $sales = Quotation::where('status', 'vendido')
    ->where('date', '>=', '2022-01-01')
    ->where('payment_status', 'Vencida')
    ->where('production_dispatched', 1)
    ->get();

    $quotationsArray = [];

    foreach($sales as $sale) {

        $expiration_days = (double)date_diff(Carbon::parse($sale->date)->addDays($sale->company->credit_days), now())->format('%R%a');

        $modifiedData["company"] = $sale->company;
        $modifiedData["expiration_days"] = $expiration_days;
        $modifiedData["total"] = $sale->total;
        $modifiedData["salesman"] = $sale->company->user;

        $quotationsArray[] = $modifiedData;

    }

    $collectiox = collect($quotationsArray);

    return $collectiox->sum('total');

});


   Route::webhooks('webhook-receiving-cliengo', 'cliengo');
   //Zenvia
   Route::webhooks('webhook-whatsapp-message', 'zenvia-whatsapp-message');
   Route::webhooks('webhook-instagram-message', 'zenvia-instagram-message');
   Route::webhooks('webhook-messenger-message', 'zenvia-messenger-message');


   Route::webhooks('webhook-messages-status', 'zenvia-message-status'); //MESSAGE STATUS


   Route::patch('/raton', function (Request $request) {
    $item = Item::updateOrCreate(
        ['sku' => request('sku')],
        ['macro' => request('macro')],
    );

    return $item;
    //$calendar = $calendar->calendars->first()->date;


       /* if(Carbon::parse($calendar)->startOfDay() > Carbon::now()->endOfDay()){
                return 'verde';
            }
            else if(Carbon::parse($calendar)->startOfDay() == Carbon::now()->startOfDay()){
                return 'amarillo';
            }
            else{
                return 'rojo';
        }*/
   });


 Route::middleware('auth:api')->post('/change-series', 'api\v2\ChangeSeriesController');
   Route::middleware('auth:api')->get('/sale_utilities', 'api\v2\sale\SaleItems');


//Login
Route::prefix('/user')->group( function() {
    Route::post('/login', 'api\v2\user\LoginUser');
    //Route::middleware('auth:api')->get('/current', 'App\Http\Controllers\api\v2\user\UserController@currentUser');
    Route::middleware('auth:api')->get('/current', 'api\v2\user\CurrentUser');

});

//Users
Route::middleware('auth:api')->group(function() {
    Route::apiResource('users', 'api\v2\user\UserController');
});

//Filters
Route::middleware('auth:api')->group(function() {
    Route::middleware('auth:api')->get('/company_p', 'api\v2\filter\CompanyPredictiveFilter');
    Route::middleware('auth:api')->get('/contact_p', 'api\v2\filter\ContactPredictiveFilter');
    Route::middleware('auth:api')->get('/sale_p', 'api\v2\filter\SaleWithCollectionsPredictiveFilter');
});

//Companies
Route::middleware('auth:api')->group(function() {
    Route::apiResource('companies', 'api\v2\company\CompanyController');
    Route::middleware('auth:api')->get('company/quotations', 'api\v2\company\CompanyQuotations');
    Route::middleware('auth:api')->post('company/sales', 'api\v2\company\CompanySales');
});


//Cfdi
Route::middleware('auth:api')->group(function() {
    Route::apiResource('cfdis', 'api\v2\cfdi\CfdiController');
});

//Frequencies
Route::middleware('auth:api')->group(function() {
    Route::apiResource('frequencies', 'api\v2\frequency\FrequencyController');
});

//Types
Route::middleware('auth:api')->group(function() {
    Route::apiResource('client-types', 'api\v2\type\TypeController');
});

//Origins
Route::middleware('auth:api')->group(function() {
    Route::apiResource('origins', 'api\v2\origin\OriginController');
});

//Statuses
Route::middleware('auth:api')->group(function() {
    Route::apiResource('statuses', 'api\v2\status\StatusController');
});

//Contacts
Route::middleware('auth:api')->group(function() {
    Route::apiResource('contacts', 'api\v2\contact\ContactController');
});

//Calendars
Route::middleware('auth:api')->group(function() {
    Route::apiResource('calendars', 'api\v2\calendar\CalendarController');
    Route::middleware('auth:api')->get('calendar/list', 'api\v2\calendar\CalendarController@calendarList');

});

//Activity
Route::middleware('auth:api')->group(function() {
    Route::apiResource('activity_types', 'api\v2\activity\ActivityController');
});

//Permission
Route::middleware('auth:api')->group(function() {
    Route::apiResource('permissions', 'api\v2\permission\PermissionController');
});

//Roles
Route::middleware('auth:api')->group(function() {
    Route::apiResource('roles', 'api\v2\role\RoleController');
});

//Calls
Route::middleware('auth:api')->group(function() {
    Route::apiResource('calls', 'api\v2\call\CallpickerCallController');
});

//Quotations
Route::middleware('auth:api')->group(function() {
    Route::apiResource('quotations', 'api\v2\quotation\QuotationController');
    Route::middleware('auth:api')->get('q', 'api\v2\quotation\QuotationFilter');

});

//Sales
Route::middleware('auth:api')->group(function() {
    Route::apiResource('sales', 'api\v2\sale\SaleController');
    Route::middleware('auth:api')->get('sale/payments', 'api\v2\quotation\QuotationPayments');
    Route::middleware('auth:api')->get('sale/totals', 'api\v2\sale\TotalIndicators');
    Route::middleware('auth:api')->post('sale/cancel', 'api\v2\sale\SaleController@cancelSale');
    Route::middleware('auth:api')->get('bar_sales_list', 'api\v2\sale\SaleController@barSales');
    Route::middleware('auth:api')->get('due_balance', 'api\v2\sale\DueBalance');
    //Route::middleware('auth:api')->post('sale/items', 'api\v2\sale\SaleController@items');

});

//Sale Items
Route::middleware('auth:api')->group(function() {
    Route::apiResource('sale_items', 'api\v2\sale\SaleItemController');
});


//Items
Route::middleware('auth:api')->group(function() {
    Route::apiResource('items', 'api\v2\item\ItemController');
    Route::middleware('auth:api')->get('item/pos', 'api\v2\item\ItemController@pos');
});

//Raw Material
Route::middleware('auth:api')->group(function() {
    Route::apiResource('raw_materials', 'api\v2\raw_material\RawMaterialController');
});

//Collections
Route::middleware('auth:api')->group(function() {
    Route::apiResource('collections', 'api\v2\collection\CollectionController');
    Route::middleware('auth:api')->get('collection/totals', 'api\v2\collection\TotalIndicators');
});

//Collection Details
Route::middleware('auth:api')->group(function() {
    Route::apiResource('collection_details', 'api\v2\collection\CollectionDetailController');
});

//Producciones
Route::middleware('auth:api')->group(function() {
    Route::apiResource('productions', 'api\v2\production\ProductionController');
});

//Report
Route::middleware('auth:api')->post('/saleman_report', 'api\v2\report\SalemanReport');
Route::middleware('auth:api')->post('/report/salesman_collection_performance', 'api\v2\report\SalesmanCollectionPerformance');
//
Route::middleware('auth:api')->get('/report/sum_total_indicators', 'api\v2\report\ReportTotalIndicators');
Route::middleware('auth:api')->get('/report/due_balance_report', 'api\v2\report\DueBalanceController');
Route::middleware('auth:api')->get('/report/collection_total', 'api\v2\report\CollectionTotalController');




//Orders

Route::prefix('/orders')->group( function() {
Route::middleware('auth:api')->get('/orders_to_dispatch', 'api\v2\order\OrderController@ordersToDispatch'); // Returns all the sales ready to be dispatched
Route::middleware('auth:api')->get('/dispatched_orders', 'api\v2\order\OrderController@dispatchedOrders'); // Returns a collection of all dispatched orders
Route::middleware('auth:api')->post('/start_order_production', 'api\v2\order\OrderController@startOrderProduction'); // Starts a Production Order
Route::middleware('auth:api')->post('/dispatch_sale_order', 'api\v2\order\OrderController@dispatchSaleOrder'); // Marks a sale order as dispathed
Route::middleware('auth:api')->get('/dispatched_sale_order_list', 'api\v2\order\OrderController@dispatchedSaleOrdersList'); 
});

//Providers
Route::middleware('auth:api')->group(function() {
Route::apiResource('providers', 'api\v2\provider\ProviderController');
});

//Shoppings
Route::middleware('auth:api')->group(function() {
    Route::apiResource('shoppings', 'api\v2\shopping\ShoppingController');
    Route::middleware('auth:api')->get('/shoppings-search', 'api\v2\shopping\ShoppingController@filter'); 
    Route::middleware('auth:api')->post('/shopping/mark-as-read', 'api\v2\shopping\MarkShoppingAsReceived'); 
    });


//Shopping Details
Route::middleware('auth:api')->group(function() {
    Route::apiResource('shopping_details', 'api\v2\shopping_detail\ShoppingDetailController');
    });

//Vehicles
Route::middleware('auth:api')->group(function() {
    Route::apiResource('vehicles', 'api\v2\vehicle\VehicleController');
    });


//Shippings
Route::middleware('auth:api')->group(function() {
    Route::apiResource('shippings', 'api\v2\shipping\ShippingController');
    Route::middleware('auth:api')->post('/shipping/bulk-create', 'api\v2\shipping\ShippingController@bulkCreate'); 
    });

//Shipping Details
Route::middleware('auth:api')->group(function() {
    Route::apiResource('shipping_details', 'api\v2\shipping_detail\ShippingDetailController');
    });

    //Leads
Route::middleware('auth:api')->group(function() {
    Route::apiResource('leads', 'api\v2\lead\LeadController');
    Route::get('lead/cursor-list', 'api\v2\lead\LeadController@cursor');
    Route::get('/lead-conversation', function (Request $request) {
        $conversation = Lead::findOrFail($request->id)->conversation;
    
        return new ConversationResource($conversation);
    });
});

//Conversations
Route::middleware('auth:api')->group(function() {
    Route::apiResource('conversations', 'api\v2\conversation\ConversationController');
});

//Messages
Route::middleware('auth:api')->group(function() {
    Route::apiResource('messages', 'api\v2\message\MessageController');
});


//Funnels
Route::middleware('auth:api')->group(function() {
    Route::apiResource('funnels', 'api\v2\funnel\FunnelController');
});

//FunnelPhases
Route::middleware('auth:api')->group(function() {
    Route::apiResource('funnel_phases', 'api\v2\funnel_phase\FunnelPhaseController');
});

//Payroll
Route::middleware('auth:api')->group(function() {
    Route::apiResource('payrolls', 'api\v2\payroll\PayrollController');
    Route::middleware('auth:api')->get('payroll/totals', 'api\v2\payroll\TotalIndicators');
});

Route::get('/perroide', function (Request $request) {
    $sales = Quotation::where('status','vendido')->get();
    $sum=0;
    foreach($sales as $sale => $value) {
        if(Quotation::findOrFail($value->id)->quotationItems()->exists()){
            if($value->type == 'Serie A'){
                $total_detalles = Quotation::findOrFail($value->id)->quotationItems->sum('total')*1.16;
            }
            else if($value->type == 'Serie B'){
                if($value->created_at > '2022-06-28 00:00:00'){
                    $total_detalles = Quotation::findOrFail($value->id)->quotationItems->sum('total')*1.16;
                }
                    else{
                    $total_detalles = Quotation::findOrFail($value->id)->quotationItems->sum('total')*1.08;
                } 
            }
        $total_cobranzas = Quotation::findOrFail($value->id)->collectionDetails->sum('amount');
        $sum = $sum + $total_detalles - $total_cobranzas;
        }
    }
    return $sum;
});

Route::get('/jirafoide', function (Request $request) {
    $sales = Quotation::all();
    foreach($sales as $key => $sale) {
        $sum = 1;
        $quotationItems = $sale->quotationItems;
        foreach($quotationItems as $key => $item) {
            $sum = $sum+($item->price*$item->quantity);
        };
    if($sale->type == 'Serie A'){
        $sale->update([
            'total' => $sum*1.16,
            'iva' => $sum*0.16,
            'subtotal' => $sum,
        ]);  
    }
    else if($sale->type == 'Serie B'){
        if($sale->created_at > '2022-06-28 00:00:00'){
            $sale->update([
                'total' => $sum*1.16,
                'iva' => $sum*0.16,
                'subtotal' => $sum,
            ]);
        }else{
            $sale->update([
                'total' => $sum*1.08,
                'iva' => $sum*0.08,
                'subtotal' => $sum,
            ]);
        } 
    }
    };
});
