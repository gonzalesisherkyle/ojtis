<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use AuthenticatesUsers;
     /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function authenticated(Request $request, $user)
    {
        // Redirect users depending on their roles
        if ( ($user->roles->pluck('role_name'))->containsStrict('Student') ) 
        {
            toast('Your are now logged in!','success');
            return redirect()->route('student-home');
        }
        elseif ( ($user->roles->pluck('role_name'))->containsStrict('Super Admin') ) 
        {
            toast('Your are now logged in!','success');
            return redirect()->route('superadmin-home');
        }
        elseif ( ($user->roles->pluck('role_name'))->containsStrict('Adviser') ) 
        {
            toast('Your are now logged in!','success');
            return redirect()->route('adviser-home');
        }
        elseif ( ($user->roles->pluck('role_name'))->containsStrict('OJT Coordinator') ) 
        {
            toast('Your are now logged in!','success');
            return redirect()->route('ojt-coordinator-home');
        }
        elseif ( ($user->roles->pluck('role_name'))->containsStrict('Head of Academics Program') )
        {
            toast('Your are now logged in!','success');
            return redirect()->route('headofacadsprog-home');
        }
        elseif ( ($user->roles->pluck('role_name'))->containsStrict('Director') ) 
        {
            toast('Your are now logged in!','success');
            return redirect()->route('director-home');
        }  
        else
        {
            Alert::error('Error', 'Something went wrong!');
            return redirect()->back();
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
