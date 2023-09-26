<?php

namespace App\Http\Controllers\DirectorControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Files;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovedRL;
use App\Mail\ApprovalRL;
use App\Mail\ApprovalMOA;
use App\Mail\DisapprovedRL;
use App\Mail\ApprovedMOA;
use App\Mail\DisapprovedMOA;

class DirectorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user();

        $letters = Files::join('users','users.user_id' ,'=','tbl_files.uploaded_by')
        ->where('tbl_files.headAcademics_approval','=','approved')
        ->where('tbl_files.category_id',8 )
        ->get();

        return view('director.files.pending-letter', compact('letters', 'user'));
    }

    public function account()
    {
        $user = Auth::user();

        return view('director.account', compact('user'));
    }

    public function pendingLetter()
    {
        $user = Auth::user();

        $letters = Files::join('users','users.user_id' ,'=','tbl_files.uploaded_by')
        ->where('tbl_files.headAcademics_approval','=','approved')
        ->where('tbl_files.category_id',8 )
        ->get();

        return view('director.files.pending-letter', compact('letters', 'user'));
    }

    public function approvedLetter()
    {
        $user = Auth::user();

        $letters = Files::join('users','users.user_id' ,'=','tbl_files.uploaded_by')
        ->where('tbl_files.director_approval','=','approved')
        ->where('tbl_files.category_id',8 )
        ->get();
        
        return view('director.files.approved-letter', compact('letters', 'user'));
    }

    public function disapprovedLetter()
    {
        $user = Auth::user();

        $letters = Files::join('users','users.user_id' ,'=','tbl_files.uploaded_by')
        ->where('tbl_files.director_approval','=','disapproved')
        ->where('tbl_files.category_id',8 )
        ->get();

        return view('director.files.disapproved-letter', compact('letters', 'user'));
    }

    public function clearRL($id)
    {
        $rLetter = Files::find($id);
        $user_id = $rLetter['uploaded_by'];
        $user = User::where('user_id', '=', $user_id)->first();
        $users = Auth::user();
       
        if($rLetter)
        {
            Mail::send(new ApprovedRL($user, $users));

            $rLetter = Files::where('file_id', $id)->update([
                'director_approval' => 'approved'
            ]);
        }
        else
        {
            Alert::error('Error', 'Something went wrong!');

            return redirect()->back();
        }
        Alert::success('Success', 'Approved Successfully!');

        return redirect()->back();
    }

    public function rejectRL($id)
    {
        $rLetter = Files::find($id);
        $user_id = $rLetter['uploaded_by'];
        $user = User::where('user_id', '=', $user_id)->first();
        $users = Auth::user();

        if($rLetter)
        {
            Mail::send(new DisapprovedRL($user, $users));       

            $rLetter = Files::where('file_id', $id)->update([
                'director_approval' => 'disapproved'
            ]);
        }
        else
        {
            Alert::error('Error', 'Something went wrong!');

            return redirect()->back();
        }
        Alert::success('Success', 'Denied Successfully!');

        return redirect()->back();
    }

    public function downloadFile($id, $file)
    {
        $user = User::where('user_id', $id)->first();
        $fileName = Files::where('uploaded_by', $id)->where('file_name', $file)->get(['file_name']);

        foreach($fileName as $name)
        {
            return response()->download(public_path('Files\\' . $user->first_name . '-' . $user->last_name . '\\'. $name['file_name']));
        }
        return redirect()->back();
    }
}