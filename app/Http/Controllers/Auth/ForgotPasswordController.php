<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Student;
use App\Mail\ResetPassword;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function forgotpassword()
    {
        return view('auth.passwords.email');
    }

    public function forgotPasswordValidate($token)
    {
        $user = User::where('password_token', $token)->first();
        if ($user) 
        {
            $email = $user->email;
            return view('auth.passwords.reset', compact('email'));
        }
        toast('Password reset link is expired!','error');
        
        return redirect()->route('forgot-password');
    }

    public function resetpassword(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if(!$user)
        {
            toast('Email does not exist!','error');

            return redirect()->back();
        }

        $token = Str::random(60);
        $user['password_token'] = $token;
        $user->save();

        Mail::to($request->email)->send(new ResetPassword($token));

        if(Mail::failures() != 0) 
        {
            toast('Password reset link has been sent to your email!','success');

            return redirect()->back();
        }
        toast('ERROR! There is some issue with the email provider!','error');

        return redirect()->back();
    }

    public function updatepassword(Request $request)
    {
        $confpass = Validator::make($request->all(), [
            'password' => 'required|min:8|string',
            'password_confirmation' => 'required|same:password' 
        ]);

        if($confpass->fails())
        {
            toast('New password does not match!','error');
        
            return redirect()->back();
        }
        $user = User::where('email', $request->email)->first();
        if($user)
        {
            User::where('email',$request->email)->update([
                'password_token' => '',
                'password' => Hash::make($request->password),
            ]); 

            Student::where('email',$request->email)->update([
                'password' => Hash::make($request->password)
            ]);

            toast('Successfully resetted your password!','success');
            
            return redirect()->route('home');
        }   
        toast('Something went wrong!','error');

        return redirect()->back();
    }

}
