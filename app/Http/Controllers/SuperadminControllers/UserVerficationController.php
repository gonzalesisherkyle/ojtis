<?php

namespace App\Http\Controllers\SuperadminControllers;

use App\Http\Controllers\Controller;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Mail\ApprovedUserMail;
use App\Mail\DisapprovedUserMail;

class UserVerficationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('status','=','unprocessed')->get();
        // dd($users);
        return view("superadmin.account-verification.users", compact('users'));
    }

    public function approveUser($id)
    {
        $user = User::find($id);
        $users = Auth::user();
        $user_role = Roles::where('tbl_roles.role_name', $user->applying_as)->first();
        // dd($user_role->role_id);
        if($user){

            Mail::send(new ApprovedUserMail($user, $users));

            User::where('user_id', $id)->update([
                'status' => 'approved',
            ]);

            $user->roles()->attach($user_role->role_id);
        }

        return redirect(route('superadmin-users'));
    }
    
    public function disapproveUser($id){
        $user = User::find($id);
        $users = Auth::user();
        if($user)
        {

            Mail::send(new DispprovedUserMail($user, $users));

            User::where('user_id', $id)->update([
                'status' => 'disapproved',
            ]);
        }

        return redirect(route('superadmin-users'));
    }
}
