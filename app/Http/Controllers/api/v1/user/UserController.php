<?php

namespace App\Http\Controllers\api\v1\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::orderBy('updated_at', 'DESC')->get();
    }

    public function currentUser(){
        return Auth::user();
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
        $user = new User();
        $user->name = $request->name;
        $user->last = $request->last;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->job_position = $request->job_position;
        $user->sub_job_position = $request->sub_job_position;
        $user->color = $request->color;
        $user->birth_date = $request->birth_date;
        $user->entry_date = $request->entry_date;
        $user->departure_date = $request->departure_date;
        $user->daily_salary = $request->daily_salary;

        
        $user->password = bcrypt($request->password);
        $user->save();
     }
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->name = $request->name;
        $user->last = $request->last;
        $user->email = $request->email;
        $user->permissions = $request->permissions;
        $user->phone = $request->phone;
        $user->job_position = $request->job_position;
        $user->sub_job_position = $request->sub_job_position;
        $user->color = $request->color;
        $user->birth_date = $request->birth_date;
        $user->entry_date = $request->entry_date;
        $user->departure_date = $request->departure_date;
        $user->daily_salary = $request->daily_salary;
        $user->save();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $user = User::destroy($request->id);
        return $user;
    }

    public function photo(Request $request)
    {
        $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('../public/files'), $fileName);
        return response()->json(['file' => $fileName]);
    }
    
    public function password(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->password = bcrypt($request->password);
        $user->save();
        return $user;
    }
    public function firstTime(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->first_time_login = $request->first_time_login;
        $user->save();
        return $user;
    }
}
