<?php

namespace App\Http\Controllers\Users;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiController;

class UserController extends ApiController
{
    /*  public function __construct()
    {
        $this->middleware('auth::api');
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::all();
        $users = UserResource::collection(User::latest()->get());
        return $users;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ];
        $this->validate($request, $rules);
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);

        return $this->showOne($user, 201);
        //return Response()->json(['data'=> $user], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //$user = User::FindorFail($user->id);
        $rules = [
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:6|confirmed'
        ];
        $this->validate($request, $rules);
        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('email') && $user->email != $request->email) {
            $user->email = $request->email;
        }

        if ($request->has('last_name')) {
            $user->last_name = $request->last_name;
        }
        if ($request->has('middle_name')) {
            $user->middle_name = $request->middle_name;
        }

        if ($request->has('password')) {
            $password = Hash::make($request->password);
            $user->password = $password;
        }
        if ($request->has('gender')) {
            $user->gender = $request->gender;
        }
        if ($request->has('address')) {
            $user->address = $request->address;
        }
        if ($request->has('phone')) {
            $user->phone = $request->phone;
        }

        if (!$user->isDirty()) {
            return $this->errorResponse('Nothing to update Friend', 422);
        }

        $user->update();
        return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('isAdmin');
        $user->delete();
        return $this->showOne($user);
    }
}
