<?php

namespace App\Http\Controllers\Students;

use Auth;
use Image;
use Input;
use App\Role;
use App\User;
use Validator;
use App\Models\Result;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\ResultResource;
use App\Http\Controllers\ApiController;
use App\Http\Resources\StudentResource;
use App\Http\Resources\SubjectResource;



class StudentController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $vans = User::whereRoleIs('student')->with('student')->get();
        // $vans = Student::with('user')->paginate();
        $vans = StudentResource::collection(Student::latest()->paginate(10));
        return $vans;
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
            // 'password' => 'required|min:6|confirmed',
            'last_name' => 'required',
            'middle_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'stream_id' => 'required',
            'parent_name' => 'required'
        ];
        $this->validate($request, $rules);
        $data = $request->all();
        $input = [
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'last_name' => $request['last_name'],
            'middle_name' => $request['middle_name'],
            'gender' => $request['gender'],
        ];
        $students = [
            'status' => $request['status'],
            'parent_name' => $request['parent_name'],
            'parent_work' => $request['parent_work'],
            'birth_date' => $request['birth_date'],
            'stream_id' => $request['stream_id'],
            'date_registered' => $request['date_registered'],
            'entered_by_id' => Auth::id(),
        ];
        $password1 = 'namespace';
        $input['password'] = Hash::make($password1);
        if ($request['img'] != null) {
            $name = time() . '.' . explode('/', explode(':', substr($request->img, 0, strpos($request->img, ';')))[1])[1];
            \Image::make($request->img)->save(public_path('img/profile/') . $name);
            $request->merge(['img' => $name]);
            $input['img'] = $name;
        }

        $user = User::create($input);

        // if($request['roles']==null){
        //     $request['roles'] = Role::whereName('student')->pluck('id');
        // }
        // $roles = Role::whereName('student')->pluck('id');

        // $user->roles()->sync(array_values($roles));
        $student = Role::whereName('student')->first();
        $user->attachRole($student);

        $user->student()->create($students);
        return $this->showOne($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\app\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $vans = new StudentResource($student);
        return $vans;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\app\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrfail($id);
        $student = $user->student;
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

        if ($request->has('status')) {
            $student->status = $request->status;
        }
        if ($request->has('parent_name')) {
            $student->parent_name = $request->parent_name;
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
        $student->entered_by_id = Auth::id();
        if (!$student->isClean()) {
            $student->update();
        }

        if (!$user->isClean()) {
            $user->update();
            return $this->showOne($user);
        }
        if (!$student->isDirty()) {
            return $this->errorResponse('Nothing to update Friend', 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\app\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $user->delete();
        $user->student()->delete();
        return $user;
    }

    public function levels(Request $request)
    {
        $level = $request->level;
        $student = $request->student;
        $vans = Result::where('student_id', $student)->where('level_id', $level)->get();
        return $vans;
    }
}
