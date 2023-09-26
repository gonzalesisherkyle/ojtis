<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Student;
use RealRashid\SweetAlert\Facades\Alert;

class ChangePasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function student()
    {
        $user = Auth::user();

        return view('student.change-password', compact('user'));
    }

    public function adviser()
    {
        $user = Auth::user();

        return view('adviser.change-password', compact('user'));
    }

    public function coordinator()
    {
        $user = Auth::user();

        return view('ojt-coordinator.change-password', compact('user'));
    }

    public function director()
    {
        $user = Auth::user();

        return view('director.change-password', compact('user'));
    }

    public function academics()
    {
        $user = Auth::user();

        return view('head-of-academics-program.change-password', compact('user'));
    }
    
    public function store(Request $request)
    {
        $email = Auth::user()->email;

        $request->validate([
            'current_password' => ['required'],
        ]);

        if (!Hash::check(($request->current_password), Auth::user()->password))
        {
            toast('Current password does not match!','error');
        
            return redirect()->back();
        }

        $confpass = Validator::make($request->all(), [
            'new_password' => 'required|min:8|string',
            'new_confirm_password' => 'same:new_password' 
        ]); 
        
        if($confpass->fails())
        {
            toast('New password does not match!','error');
        
            return redirect()->back();
        }

        if(strcmp($request->current_password, $request->new_password) == 0)
        {
            toast('New Password cannot be same as your current password!','error');
        
            return redirect()->back();
        }

        User::find(Auth::id())->update([
            'password'=> Hash::make($request->new_password)
        ]);

        Student::where('email',$email)->update([
            'password'=> Hash::make($request->new_password)
        ]);

        toast('Successfully changed your password!','success');
        
        return redirect()->back();
    }
}
