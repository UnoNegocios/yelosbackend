<?php

namespace App\Actions\Collections;
use App\Models\Inventory;
use App\Models\Collection;
use Illuminate\Support\Facades\Log;
use App\Models\CollectionDetail;
use App\Models\Quotation;


class CreateNewCollection
{

    public function __construct()
    {

    }

    public function excecute($request)
    {      
        $this->createNewCollection($request);
    }

    public function createNewCollection($request)
    {
       //$data = Collection::create($request->all());
       $collection = new Collection();

       $collection->salesID = $request->salesID;
       $collection->macro = $request->macro;
       $collection->date = $request->date;
       $collection->payment_method_id = $request->payment_method_id;
       $collection->amount = $request->amount;
       $collection->invoice = $request->invoice;
       $collection->note = $request->note;
       $collection->pdf = $request->pdf;
       $collection->serie = $request->serie;
       $collection->created_by_user_id = $request->created_by_user_id;
       $collection->last_updated_by_user_id = $request->last_updated_by_user_id;
       $collection->user_id = $request->user_id;
       $collection->company_id = $request->company_id;
       $collection->remission = $request->remission;
       $collection->methods = $request->methods;


        $collection->save();
        $data = $collection;

        $this->createCollectionDetail($request, $data->id);
    }

    public function createCollectionDetail($request, $id)
    {
        $data = $request['salesID'];
        foreach($data as $key => $value){
            $collection_detail = new CollectionDetail();
            $collection_detail->collection_id = $id;
            $collection_detail->amount = $value['amount'];
            $collection_detail->due = $value['due'];
            $collection_detail->new_due = $value['newDue'];
            $collection_detail->sale_id = $value['id'];
            $collection_detail->save();

            $this->updateQuotationInvoice($value, $request);
        }
    }

    public function updateQuotationInvoice($value, $request){
        $invoice = Quotation::findOrFail($value['id']);
        $invoice->update([
            'invoice' => $value['invoice'],
            'invoice_date' => $value['invoice_date'],
            'type' => $request['serie'],
        ]);
    }
}