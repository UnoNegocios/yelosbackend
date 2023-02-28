<?php

namespace App\Http\Controllers\api\v1\collection;

use App\Models\Collection;
use App\Models\CollectionDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Actions\Collections\CreateNewCollection;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewCollections")){
            $collection = Collection::orderBy('updated_at', 'DESC')
            //->where('date', '>=', '2022-01-01')
            ->get();
        }else{
            $collection = Collection::where('user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')
            //->where('date', '>=', '2022-01-01')
            ->get();
        }
        return $collection;
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
        $new = new CreateNewCollection();
        $new->excecute($request);
        
        //$collection = new Collection();
/*
        $collection->salesID = $request->salesID;
        $collection->macro = $request->macro;
        $collection->date = $request->date;
        $collection->payment_method_id = $request->payment_method_id;
        $collection->amount = $request->amount;
        $collection->invoice = $request->invoice;
        $collection->note = $request->note;
        $collection->pdf = $request->pdf;
        $collection->created_by_user_id = $request->created_by_user_id;
        $collection->last_updated_by_user_id = $request->last_updated_by_user_id;
        $collection->user_id = $request->user_id;
        $collection->company_id = $request->company_id;
        $collection->remission = $request->remission;
        $collection->methods = $request->methods;
    
        $collection->save();
        */
        return response(null, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function show(Collection $collection)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function edit(Collection $collection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Collection $collection)
    {
        $collection = Collection::findOrFail($request->id);
        
        $collection->salesID = $request->salesID;
        $collection->macro = $request->macro;
        $collection->date = $request->date;
        $collection->payment_method_id = $request->payment_method_id;
        $collection->amount = $request->amount;
        $collection->invoice = $request->invoice;
        $collection->note = $request->note;
        $collection->pdf = $request->pdf;
        $collection->created_by_user_id = $request->created_by_user_id;
        $collection->last_updated_by_user_id = $request->last_updated_by_user_id;
        $collection->user_id = $request->user_id;
        $collection->company_id = $request->company_id;
        $collection->remission = $request->remission;
        $collection->methods = $request->methods;
        $collection->payment_complement = $request->payment_complement;

        $collection->save();
        return $collection;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Collection  $collection
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $collection = Collection::destroy($request->id);
        return $collection;  
    } 

    public function files(Request $request){
        $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('../public/files'), $fileName);
        return response()->json(['file' => $fileName]);
    }  

    public function bulkCollectionDetail(Request $request) {
        $data = $request->all();
     
         foreach ($data as $key => $value) {

            CollectionDetail::create([
               'amount' => $value['amount'],
               'due' => $value['due'],
               'new_due' => $value['new_due'],
               'collection_id' =>$value['collection_id'],
               'sale_id' => $value['sale_id'],
               'created_at' => $value['created_at'],
               'updated_at' => $value['updated_at'],
            ]);
           };

        }

    public function bulkCollectionUpdate(Request $request) {
        $data = $request->all();

        foreach ($data as $key => $value) {
      
         $perro = Collection::findOrFail($value['id'])
         ->update([
         // 'serie' => $value['serie'],
          'payment_method_id' => $value['payment_method_id'],
         ]);
        }
    }

}
