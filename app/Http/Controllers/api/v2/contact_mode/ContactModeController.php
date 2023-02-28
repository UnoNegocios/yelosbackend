<?php

namespace App\Http\Controllers\api\v2\contact_mode;

use Illuminate\Http\Request;
use App\Models\ContactMode;
use App\Http\Controllers\Controller;
use App\Http\Resources\contact_mode\ContactModeResource;
use App\Http\Requests\contact_mode\StoreContactModeRequest;
use App\Http\Requests\contact_mode\UpdateContactModeRequest;
use Illuminate\Support\Facades\Hash;

class ContactModeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ContactModeResource::collection(ContactMode::all());
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
    public function store(StoreContactModeRequest $request)
    {
        $validated = $request->validated();
        
        $contact_mode = ContactMode::create(
            $validated
        );
        return response(null, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ContactMode $contact_mode)
    {
        return new ContactModeResource($contact_mode);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateContactModeRequest $request, ContactMode $contact_mode)
    {
        $validated = $request->validated();
        $contact_mode->update($validated);
        return $contact_mode;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactMode $contact_mode)
    {
        $contact_mode->delete();
        return response(null, 204);
    }
}
