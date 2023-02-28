<?php

namespace App\Http\Controllers\api\v1\note;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $note = Note::where('to_user_id', Auth::user()->id)->orWhere('from_user_id', Auth::user()->id)->get();
        
        return $note;
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
        $note = new Note();
        $note->comment = $request->comment;
        $note->seen = $request->seen;
        $note->from_user_id = $request->from_user_id;
        $note->to_user_id = $request->to_user_id;
        $note->company_id = $request->company_id;
        $note->contact_id = $request->contact_id;
        $note->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        $note = Note::findOrFail($request->id);
        return $note;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $contact)
    {
        $note = Note::findOrFail($request->id);
        $note->comment = $request->comment;
        $note->seen = $request->seen;
        $note->from_user_id = $request->from_user_id;
        $note->to_user_id = $request->to_user_id;
        $note->company_id = $request->company_id;
        $note->contact_id = $request->contact_id;
        $note->save();

        return $note;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $note = Note::destroy($request->id);
        return $note;
    }
}
