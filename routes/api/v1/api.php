<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\api\v1\LoginController;
use App\Models\Shopping;
use App\Models\Company;
use App\Models\Expense;
use App\Models\QuotationItem;
use App\Models\Payroll;
use App\Models\ProviderPayment;
use App\Models\Collection;
use App\Models\Log;


use App\Models\ShoppingDetail;
use App\Models\Quotation;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();
//});

/*Route::post('/perro', function (Request $request) {
   $data = $request->all();

    foreach ($data as $key => $value) {
        //return $value;
        //return $data;
        Vehicle::create([
          'name'=> $data[$key]['name'],
      ]);
        //return $data;
      };
  //Vehicle::insert($data);
  //return $data;
  
});*/

Route::post('/andrea', function (Request $request) {
 
  $data = $request->all();

  foreach($data as $key => $value){
    $model = Collection::findOrFail($value['id'])
    ->update([
      'invoice' => $value['new_invoice'],
      'remission' => $value['new_remission'],
      'amount' => $value['new_amount'],
      'methods' => $value['new_methods'],
      'last_updated_by_user_id' => $value['new_last_updated_by_user_id']
    ]);
  }
});

Route::post('/compras', function (Request $request) {
 
  $data = $request->all();

  foreach($data as $key => $value){
    $model = Shopping::findOrFail($value['id'])
    ->update([
      'created_at' => $value['new_created_at'],
      'updated_at' => $value['new_updated_at']
    ]);
  }
});

Route::post('/empresas', function (Request $request) {
 
  $data = $request->all();

  foreach($data as $key => $value){
    $model = Company::findOrFail($value['id'])
    ->update([
      'created_at' => $value['new_created_at'],
      'updated_at' => $value['new_updated_at']
    ]);
  }
});

Route::post('/gastos', function (Request $request) {
 
  $data = $request->all();

  foreach($data as $key => $value){
    $model = Expense::findOrFail($value['id'])
    ->update([
      'created_at' => $value['new_created_at'],
      'updated_at' => $value['new_updated_at']
    ]);
  }
});

Route::post('/nomina', function (Request $request) {
 
  $data = $request->all();

  foreach($data as $key => $value){
    $model = Payroll::findOrFail($value['id'])
    ->update([
      'created_at' => $value['new_created_at'],
      'updated_at' => $value['new_updated_at']
    ]);
  }
});

Route::post('/pago_provedores', function (Request $request) {
 
  $data = $request->all();

  foreach($data as $key => $value){
    $model = ProviderPayment::findOrFail($value['id'])
    ->update([
      'created_at' => $value['new_created_at'],
      'updated_at' => $value['new_updated_at']
    ]);
  }
});

Route::post('/ventas', function (Request $request) {
 
  $data = $request->all();

  foreach($data as $key => $value){
    $model = Quotation::findOrFail($value['id'])
    ->update([
      'created_at' => $value['new_created_at'],
      'updated_at' => $value['new_updated_at']
    ]);
  }
});

Route::post('/cobranzas', function (Request $request) {
 
  $data = $request->all();

  foreach($data as $key => $value){
    $model = Collection::findOrFail($value['id'])
    ->update([
      'created_at' => $value['new_created_at'],
      'updated_at' => $value['new_updated_at']
    ]);
  }
});

Route::post('/compra_detalle', function (Request $request) {
 
  $data = $request->all();

  foreach($data as $key => $value){
    $model = ShoppingDetail::findOrFail($value['id'])
    ->update([
      'created_at' => $value['new_created_at'],
      'updated_at' => $value['new_updated_at']
    ]);
  }
});


Route::get('/cd', function (Request $request) {
 
return CollectionDetail::all();
});

Route::get('/qi', function (Request $request) {
 
  return QuotationItem::all();
  });

Route::post('/gato', 'api\v1\quotation\DispatchQuotationOrder');


//Imagenes-Item
Route::prefix('/media')->group( function() {
  Route::middleware('auth:api')->get('/item/{image}');
});

//Webhooks
Route::webhooks('webhook-receiving-callpicker', 'callpicker');
Route::webhooks('webhook-receiving-vonage', 'vonage');
Route::webhooks('webhook-receiving-zenvia', 'zenvia');
Route::webhooks('webhook-receiving-cliengo', 'cliengo');


//Users
Route::prefix('/user')->group( function() {
  Route::post('/login', 'api\v1\LoginController@Login');
  Route::middleware('auth:api')->get('/all', 'api\v1\user\UserController@index');
  Route::middleware('auth:api')->get('/current', 'api\v1\user\UserController@currentUser');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\user\UserController@destroy');
  Route::middleware('auth:api')->put('/update', 'api\v1\user\UserController@update');
  Route::middleware('auth:api')->put('/password', 'api\v1\user\UserController@password');
  Route::middleware('auth:api')->post('/create', 'api\v1\user\UserController@store');
  Route::middleware('auth:api')->post('/photo', 'api\v1\user\UserController@photo');
});


//empresa
Route::prefix('/company')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\company\CompanyController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\company\CompanyController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\company\CompanyController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\company\CompanyController@destroy');
  Route::middleware('auth:api')->get('/search', 'api\v1\company\CompanyController@show');
});

//contacto
Route::prefix('/contact')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\contact\ContactController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\contact\ContactController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\contact\ContactController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\contact\ContactController@destroy');
  Route::middleware('auth:api')->get('/search', 'api\v1\contact\ContactController@show');
});

//cotización
Route::prefix('/quotation')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\quotation\QuotationController@index');
  Route::middleware('auth:api')->get('/quotations', 'api\v1\quotation\QuotationController@quotations');
  Route::middleware('auth:api')->get('/sales', 'api\v1\quotation\QuotationController@sales');
  Route::middleware('auth:api')->get('/cancellations', 'api\v1\quotation\QuotationController@cancellations');
  Route::middleware('auth:api')->put('/update', 'api\v1\quotation\QuotationController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\quotation\QuotationController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\quotation\QuotationController@destroy');

  Route::middleware('auth:api')->put('/make-sale', 'api\v1\quotation\QuotationController@makeSale');
  Route::middleware('auth:api')->put('/bar-bulk-update', 'api\v1\quotation\QuotationController@barSalesBulkUpdate');
  Route::middleware('auth:api')->post('/dispatch', 'api\v1\quotation\QuotationController@dispatchSale');
  Route::middleware('auth:api')->post('/bulk-create', 'api\v1\quotation\QuotationItemController@bulkCreate');
  Route::middleware('auth:api')->put('/print-sale', 'api\v1\quotation\PrintSale');




  //Route::post('/store-multiple-files/{tenant}','api\v1\quotation\QuotationController@files');
  Route::post('/files','api\v1\quotation\QuotationController@files');
});

//categorías
Route::prefix('/category')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\category\CategoryController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\category\CategoryController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\category\CategoryController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\category\CategoryController@destroy');
});

//productos-servicios
Route::prefix('/item')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\item\ItemController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\item\ItemController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\item\ItemController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\item\ItemController@destroy');

  Route::middleware('auth:api')->put('/bulkupdate', 'api\v1\item\ItemController@bulkUpdate');
  Route::middleware('auth:api')->put('/bulk_patch_raw_materials', 'api\v1\item\ItemController@bulkpatch');


  Route::post('/files','api\v1\item\ItemController@files');
});

//unidades de medida
Route::prefix('/unit')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\unit\UnitController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\unit\UnitController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\unit\UnitController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\unit\UnitController@destroy');
});

//calendario
Route::prefix('/calendar')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\calendar\CalendarController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\calendar\CalendarController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\calendar\CalendarController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\calendar\CalendarController@destroy');
});

//tipos de actividades
Route::prefix('/activity')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\activity\ActivityController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\activity\ActivityController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\activity\ActivityController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\activity\ActivityController@destroy');
});

//procedencias
Route::prefix('/origin')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\origin\OriginController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\origin\OriginController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\origin\OriginController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\origin\OriginController@destroy');
});

//etapas 
Route::prefix('/phase')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\phase\PhaseController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\phase\PhaseController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\phase\PhaseController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\phase\PhaseController@destroy');
});

//estatus
Route::prefix('/status')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\status\StatusController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\status\StatusController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\status\StatusController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\status\StatusController@destroy');
});

//motivos de rechazo
Route::prefix('/rejection')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\rejection\RejectionController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\rejection\RejectionController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\rejection\RejectionController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\rejection\RejectionController@destroy');
});

 //notas
 Route::prefix('/note')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\note\NoteController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\note\NoteController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\note\NoteController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\note\NoteController@destroy');
});

//bitacora
Route::prefix('/log')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\log\LogController@index');
});


//cfdi
Route::prefix('/cfdi')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\cfdi\CfdiController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\cfdi\CfdiController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\cfdi\CfdiController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\cfdi\CfdiController@destroy');
});

//tipo de cliente
Route::prefix('/type')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\type\TypeController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\type\TypeController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\type\TypeController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\type\TypeController@destroy');
});

//zona
Route::prefix('/zone')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\zone\ZoneController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\zone\ZoneController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\zone\ZoneController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\zone\ZoneController@destroy');
});

//medio de contacto
Route::prefix('/contact_mode')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\contact_mode\ContactModeController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\contact_mode\ContactModeController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\contact_mode\ContactModeController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\contact_mode\ContactModeController@destroy');
});

//condicion especial de entrega
Route::prefix('/special_condition')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\special_condition\ConditionController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\special_condition\ConditionController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\special_condition\ConditionController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\special_condition\ConditionController@destroy');
});

//metodo de pago
Route::prefix('/payment_method')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\payment_method\MethodController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\payment_method\MethodController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\payment_method\MethodController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\payment_method\MethodController@destroy');
});

//frecuencia de consumo
Route::prefix('/frequency')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\frequency\FrequencyController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\frequency\FrequencyController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\frequency\FrequencyController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\frequency\FrequencyController@destroy');
});

//lista de precios
Route::prefix('/price_list')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\price_list\PriceListController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\price_list\PriceListController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\price_list\PriceListController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\price_list\PriceListController@destroy');
});

//callpciker calls
Route::prefix('/call')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\callpcikercall\CallpickerCallController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\callpcikercall\CallpickerCallController@update');
});

//message
Route::prefix('/message')->group( function(){
  Route::middleware('auth:api')->get('/all/{id}', 'api\v1\message\MessageController@index');
  Route::middleware('auth:api')->post('/create', 'api\v1\message\MessageController@store');
});
//message_statusstatus de mensajes
Route::prefix('/message_status')->group( function(){
  Route::middleware('auth:api')->get('/all/{id}', 'api\v1\message_status\MessageStatusController@index');
  Route::middleware('auth:api')->post('/create', 'api\v1\message_status\MessageStatusController@store');
});
//conversation
Route::prefix('/conversation')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\conversation\ConversationController@index');
  Route::middleware('auth:api')->post('/create', 'api\v1\conversation\ConversationController@store');
});



//cobranza
Route::prefix('/collection')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\collection\CollectionController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\collection\CollectionController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\collection\CollectionController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\collection\CollectionController@destroy');
  Route::middleware('auth:api')->post('/bulk-update', 'api\v1\collection\CollectionController@bulkCollectionUpdate');
  Route::post('/files','api\v1\collection\CollectionController@files');
  //////collection detail
  Route::middleware('auth:api')->post('/bulk-collection-detail', 'api\v1\collection\CollectionController@bulkCollectionDetail');
});
//envios
Route::prefix('/shipping')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\shipping\ShippingController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\shipping\ShippingController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\shipping\ShippingController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\shipping\ShippingController@destroy');
});
//detalle de envios
Route::prefix('/shipping_detail')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\shipping\DetailController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\shipping\DetailController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\shipping\DetailController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\shipping\DetailController@destroy');
  Route::middleware('auth:api')->put('/shipping-detail-bulk-update', 'api\v1\shipping\DetailController@barSalesBulkUpdate');

  Route::post('/files','api\v1\shipping\DetailController@files');
});
//gastos
Route::prefix('/expense')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\expense\ExpenseController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\expense\ExpenseController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\expense\ExpenseController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\expense\ExpenseController@destroy');
});

//tipos de gastos
Route::prefix('/expense_type')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\expense\ExpenseTypeController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\expense\ExpenseTypeController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\expense\ExpenseTypeController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\expense\ExpenseTypeController@destroy');
});

//nominas
Route::prefix('/payroll')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\payroll\PayrollController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\payroll\PayrollController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\payroll\PayrollController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\payroll\PayrollController@destroy');
});


//produccion
Route::prefix('/production')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\production\ProductionController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\production\ProductionController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\production\ProductionController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\production\ProductionController@destroy');
});
//detalle de produccion
Route::prefix('/production_detail')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\production\ProductionDetailController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\production\ProductionDetailController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\production\ProductionDetailController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\production\ProductionDetailController@destroy');
});
//ajustes
Route::prefix('/adjustment')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\adjustment\AdjustmentController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\adjustment\AdjustmentController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\adjustment\AdjustmentController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\adjustment\AdjustmentController@destroy');
});
//compras
Route::prefix('/shopping')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\shopping\ShoppingController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\shopping\ShoppingController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\shopping\ShoppingController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\shopping\ShoppingController@destroy');
});
//detalle de compras
Route::prefix('/shopping_detail')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\shopping\ShoppingDetailController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\shopping\ShoppingDetailController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\shopping\ShoppingDetailController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\shopping\ShoppingDetailController@destroy');
});
//proveedores
Route::prefix('/provider')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\provider\ProviderController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\provider\ProviderController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\provider\ProviderController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\provider\ProviderController@destroy');
});
//pagos proveedores
Route::prefix('/provider_payment')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\provider_payment\ProviderPaymentController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\provider_payment\ProviderPaymentController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\provider_payment\ProviderPaymentController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\provider_payment\ProviderPaymentController@destroy');
});
//cortes de resultados
Route::prefix('/result')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\result\ResultController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\result\ResultController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\result\ResultController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\result\ResultController@destroy');
});
//insumos
Route::prefix('/supply')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\supply\SupplyController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\supply\SupplyController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\supply\SupplyController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\supply\SupplyController@destroy');
});
//vehiculos
Route::prefix('/vehicle')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\vehicle\VehicleController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\vehicle\VehicleController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\vehicle\VehicleController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\vehicle\VehicleController@destroy');
});

//inventory
Route::prefix('/inventory')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\inventory\InventoryController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\inventory\InventoryController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\inventory\InventoryController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\inventory\InventoryController@destroy');
  Route::middleware('auth:api')->post('/bulkstore', 'api\v1\inventory\InventoryController@bulkCreate');
});

//Solicitud de compras
Route::prefix('/shopping_order')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\shopping\ShoppingOrderController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\shopping\ShoppingOrderController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\shopping\ShoppingOrderController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\shopping\ShoppingOrderController@destroy');
});

//Solicitud de producción
Route::prefix('/production_order')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\shopping\ProductionOrderController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\shopping\ProductionOrderController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\shopping\ProductionOrderController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\shopping\ProductionOrderController@destroy');
});

//Inventario Fisico
Route::prefix('/physical_inventory')->group( function(){
  Route::middleware('auth:api')->get('/all', 'api\v1\inventory\PhysicalInventoryController@index');
  Route::middleware('auth:api')->put('/update', 'api\v1\inventory\PhysicalInventoryController@update');
  Route::middleware('auth:api')->post('/create', 'api\v1\inventory\PhysicalInventoryController@store');
  Route::middleware('auth:api')->delete('/delete/{id}', 'api\v1\inventory\PhysicalInventoryController@destroy');
});