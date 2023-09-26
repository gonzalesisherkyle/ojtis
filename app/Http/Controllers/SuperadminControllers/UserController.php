<?php

namespace App\Http\Controllers\SuperadminControllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\Roles;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Mail\NewPassword;
use App\Mail\NewStudent;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        $users = User::where('status', '=', 'approved')->get();
        return view("superadmin.user-management.users", compact('users', 'user'));
    }

    public function reset($id)
    {
        $user = User::where('user_id', $id)->first();
        $password = str::random(16);
        $email = $user->email;

        User::where('user_id', $id)->update([
            'password' => Hash::make($password),
        ]);

        if ($user->applying_as == "Student") {
            Student::where('email', $email)->update([
                'password' => Hash::make($password),
            ]);
        }

        Mail::send(new NewPassword($password, $email));

        toast('Resetted successfully!', 'success');

        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("superadmin.user-management.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'applying_as' => ['required', 'string'],
        ]);

        $password = str::random(16);
        $email = $request['email'];
        $user_role = Roles::where('tbl_roles.role_name', $request['applying_as'])->first();

        $user = User::create([
            'email' => $request['email'],
            'password' => Hash::make($password),
            'applying_as' => $request['applying_as'],
            'status' => 'approved',
        ]);

        $user = User::where('email', $email)->first();
        $user->roles()->attach($user_role->role_id);

        Mail::send(new NewStudent($password, $email));

        toast('Added successfully!', 'success');

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $users = User::find($id);

        return view("superadmin.user-management.view-user", compact('users', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $users = User::find($id);

        return view("superadmin.user-management.edit-user", compact('users', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable'],
            'address' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->user_id, 'user_id')],
            'student_number' => ['nullable', 'string', 'max:50', Rule::unique('users')->ignore($user)],
            'year_and_section' => ['nullable', 'string', 'max:255'],
            'course_id' => ['nullable', 'string'],
            'contact_number' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
        ]);

        User::where('user_id', $id)->update([
            'first_name' => $request['first_name'],
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            'suffix' => $request['suffix'],
            'email' => $request['email'],
            'student_number' => $request['student_number'],
            'year_and_section' => $request['year_and_section'],
            'course_id' => $request['course_id'],
            'contact_number' => $request['contact_number'],
            'address' => $request['address'],
            'date_of_birth' => $request['date_of_birth'],
        ]);

        if ($user->applying == 'Student') {
            Student::where('emai', $user->email)->update([
                'first_name' => $request['first_name'],
                'middle_name' => $request['middle_name'],
                'last_name' => $request['last_name'],
                'suffix' => $request['suffix'],
                'email' => $request['email'],
                'student_number' => $request['student_number'],
                'year_and_section' => $request['year_and_section'],
                'course_id' => $request['course_id'],
                'contact_number' => $request['contact_number'],
                'address' => $request['address'],
                'date_of_birth' => $request['date_of_birth'],
            ]);
        }

        toast('Updated successfully!', 'success');

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return view("superadmin.user-management.users");
    }


}