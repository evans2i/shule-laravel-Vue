<?php

namespace App\Http\Controllers\Staffs;

use Auth;
use Image;
use Input;
use App\Role;
use App\User;
use Validator;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\StaffResource;
use App\Http\Controllers\ApiController;

class StaffController extends ApiController
{
    public function index()
    {
        // $vans = User::whereRoleIs('staff')->with('staff')->get();
        $vans = StaffResource::collection(Staff::latest()->get());  
        // return $this->showAll($vans);
        return $vans;
    }

    public function store(Request $request)
    {

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            // 'password' => 'required|min:6|confirmed',
            'last_name' => 'required',
            'middle_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'title' => 'required',
            'qualification' => 'required',
            'employed_date' => 'required',
        ];
        $this->validate($request, $rules);
        $input = [
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'last_name' => $request['last_name'],
            'middle_name' => $request['middle_name'],
            'gender' => $request['gender'],
        ];
        $staffs = [
            'title' => $request['title'],
            'position' => $request['position'],
            'qualification' => $request['qualification'],
            'employed_date' => $request['employed_date'],
            'description' => $request['description'],
            'entered_by_id' => Auth::id(),
        ];
        $password1 = 'password';
        $input['password'] = Hash::make($password1);
        if ($request['img'] != null) {
            $name = time() . '.' . explode('/', explode(':', substr($request->img, 0, strpos($request->img, ';')))[1])[1];
            \Image::make($request->img)->save(public_path('img/profile/') . $name);
            $request->merge(['img' => $name]);
            $input['img'] = $name;
        }

        $user = User::create($input);

        // if($request['roles']==null){
        //         $request['roles'] = [];
        //     }
        // $user->roles()->sync(array_values($request['roles']));
        $staff = Role::whereName('staff')->first();
        $user->attachRole($staff);

        $user->staff()->create($staffs);
        return $this->showOne($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\app\Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        $staff->user;
        // return $this->showOne($staff, 200);
        return new StaffResource($staff);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrfail($id);
        $staff = $user->staff;
        $rules = [
            'email' => 'email|unique:users,email,' . $user->id,
            'password' => 'min:6|confirmed',
        ];
        $this->validate($request, $rules);

        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('last_name')) {
            $user->last_name = $request->last_name;
        }
        if ($request->has('middle_name')) {
            $user->middle_name = $request->middle_name;
        }
        if ($request->has('email') && $user->email != $request->email) {
            $user->email = $request->email;
        }
        if ($request->has('password')) {
            $password = Hash::make($request->password);
            $user->password = $password;
        }
        $user->update();

        if ($request->has('title')) {
            $staff->title = $request->title;
        }
        if ($request->has('position')) {
            $staff->position = $request->position;
        }
        if ($request->has('qualification')) {
            $staff->qualification = $request->qualification;
        }
        if ($request->has('employed_date')) {
            $staff->employed_date = $request->employed_date;
        }
        if ($request->has('description')) {
            $staff->description = $request->description;
        }
        $staff->entered_by_id = Auth::id();

        if (!$user->isClean()) {
            $user->update();
        }

        if (!$staff->isClean()) {
            $staff->update();
            return $user;
        }
        if (!$staff->isDirty()) {
            return $this->errorResponse('Nothing to update Friend', 422);
        }
    }

    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $user->delete();
        $user->staff()->delete();
        return $user;
    }
}
