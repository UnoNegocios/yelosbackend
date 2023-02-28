<?php

namespace App\Http\Controllers\api\v1\contact;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(strpos(json_encode(Auth::user()->permissions), "viewContacts")){
            $contact = Contact::all();
        }else{
            $contact = Contact::where('user_id', Auth::user()->id)->get();
        }
        return $contact;
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
        $contact = new Contact();
        $contact->company_id = $request->company_id;
        $contact->name = $request->name;
        $contact->last = $request->last;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->job_position = $request->job_position;
        $contact->user_id = $request->user_id;
         $contact->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        $contact = Contact::findOrFail($request->id);
        return $contact;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $contact = Contact::findOrFail($request->id);
        $contact->company_id = $request->company_id;
        $contact->name = $request->name;
        $contact->last = $request->last;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->job_position = $request->job_position;
        $contact->user_id = $request->user_id;
        $contact->save();

        return $contact;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $contact = Contact::destroy($request->id);
        return $contact;
    }
}
