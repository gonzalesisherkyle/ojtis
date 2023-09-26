<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\ApprovalMail;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Register;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function register()
    {
        $advisers = User::where('applying_as', 'Adviser')->get();

        return view('auth.register', compact('advisers'));

        // $this->middleware('guest');
    }

    public function pending(Request $request)
    {
        // dd($request);
        $emails = User::all();
        $pending = Register::all();

        foreach($emails as $email)
        {
            if($request->email == $email->email)
            {
                toast('Email already registered!','error');

                return redirect()->back();
            }
        }
        
        foreach ($pending as $pending)
        {
            if($request->email == $pending->email)
            {
                if($request->adviser == $pending->adviser_id)
                {
                    if($pending->status == 'pending')
                    {
                        toast('Already have a pending request for that adviser!','error');

                        return redirect()->back();
                    }
                }
            }
        }
        Register::create([
            'adviser_id' => $request->adviser,
            'course_id' => $request->course_id,
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email' => $request->email,
            'year_and_section' => $request->year_and_section,
            'status' => 'pending',
        ]);

        toast('Success! Wait for adviser\'s approval','success');

        return redirect()->back();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
       
        return Validator::make($data, [
              
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => [ 'nullable','max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable'],
            'address' => ['required','string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'student_number' => ['nullable', 'string', 'max:50', 'unique:users'],
            'year_and_section' => ['nullable', 'string', 'max:255'],
            'course_id' => ['nullable', 'string'],
            'contact_number' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
            'applying_as' => ['required', 'string'],


        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        Mail::send(new ApprovalMail());

        $user = User::create([
            'first_name' => $data['first_name'],
            'middle_name' => $data['middle_name'],
            'last_name' => $data['last_name'],
            'suffix' => $data['suffix'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'student_number' =>$data['student_number'],
            'year_and_section' => $data['year_and_section'],
            'course_id' => $data['course_id'],
            'contact_number' => $data['contact_number'],
            'address' => $data['address'],
            'date_of_birth' => $data['date_of_birth'],
            'applying_as' => $data['applying_as'],
            
        ]);

        return $user;
    }
}
