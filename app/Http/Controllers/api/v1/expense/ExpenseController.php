<?php

namespace App\Http\Controllers\api\v1\expense;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewExpenses")){
            $expense = Expense::orderBy('updated_at', 'DESC')->get();
        }else{
            $expense = Expense::where('created_by_user_id', Auth::user()->id)->orderBy('updated_at', 'DESC')->get();
        }
        return $expense;
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
        $expense = new Expense();

        $expense->concept = $request->concept;
        $expense->type = $request->type;
        $expense->provider_id = $request->provider_id;
        $expense->serie = $request->serie;
        $expense->payment_method_id = $request->payment_method_id;
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        $expense->invoice = $request->invoice;
        $expense->due_date = $request->due_date;
        $expense->payment_date = $request->payment_date;
        $expense->paid = $request->paid;
        $expense->notes = $request->notes;
        $expense->pdf = $request->pdf;
        $expense->created_by_user_id = $request->created_by_user_id;
        $expense->last_updated_by_user_id = $request->last_updated_by_user_id;
    
        $expense->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $expense = Expense::findOrFail($request->id);
        
        $expense->concept = $request->concept;
        $expense->type = $request->type;
        $expense->provider_id = $request->provider_id;
        $expense->serie = $request->serie;
        $expense->payment_method_id = $request->payment_method_id;
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        $expense->invoice = $request->invoice;
        $expense->due_date = $request->due_date;
        $expense->payment_date = $request->payment_date;
        $expense->paid = $request->paid;
        $expense->notes = $request->notes;
        $expense->pdf = $request->pdf;
        $expense->created_by_user_id = $request->created_by_user_id;
        $expense->last_updated_by_user_id = $request->last_updated_by_user_id;


        $expense->save();
        return $expense;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $expense = Expense::destroy($request->id);
        return $expense;  
    }

    public function files(Request $request){
        $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('../public/files'), $fileName);
        return response()->json(['file' => $fileName]);
    }  
}
