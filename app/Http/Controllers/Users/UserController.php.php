<?php

namespace App\Http\Controllers\Users;

use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\ApiController;
use Image;


class UserController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
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

    public function getauth()
    {
//        $data = auth('api')->user();

        $data =Auth::user();
        return $data;
    }

    public function postauth(Request $request)
    {
//        $user = auth('api')->user();
        $user = Auth::user();

        $rules = [
            'email' => 'email|unique:users,email,' . $user->id,
        ];
        $this->validate($request, $rules);
//        dd($request->all());


        if ($request->has('name') && $request->name != null) {
            $user->name = $request->name;
        }
        if ($request->has('email') && $user->email != $request->email && $request->email != null) {
            $user->email = $request->email;
        }

        if ($request->has('last_name') && $request->last_name != null) {
            $user->last_name = $request->last_name;
        }
        if ($request->has('middle_name') && $request->middle_name != null) {
            $user->middle_name = $request->middle_name;
        }

        if ($request->has('gender') && $request->gender != null) {
            $user->gender = $request->gender;

        }
        if ($request->has('address') && $request->address != null) {
            $user->address = $request->address;
        }
        if ($request->has('phone') && $request->phone != null) {
            $user->phone = $request->phone;
        }

        if ($request->has('password') && $request->password != null) {
            $password = Hash::make($request->password);
            $user->password = $password;
        }

        $current_img = $user->img;
        if ($request->img != $current_img && $request->img != null) {
            $image = time() . '.' . explode('/', explode(':', substr($request->img, 0, strpos($request->img, ';')))[1])[1];
            $file =  Image::make($request->img)->save(public_path('profile/').$image);

            $user->img = $image;

            $currentP = public_path('profile/').$current_img;
            if(file_exists($currentP)){
                @unlink($currentP);
            }
        }



        if (!$user->isDirty()) {
            return $this->errorResponse('Nothing to update Friend', 422);
        }

        $user->update();
        return $this->showOne($user);
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
