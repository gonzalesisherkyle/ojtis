<?php

namespace App\Http\Controllers\OJTCoordinatorControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Files;
use App\Models\File_Categories;
use App\Models\Moa_Files;
use App\Models\User;
use App\Models\Course;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\ApprovedRL;
use App\Mail\ApprovalRL;
use App\Mail\ApprovalMOA;
use App\Mail\DisapprovedRL;
use App\Mail\ApprovedMOA;
use App\Mail\DisapprovedMOA;
use App\Mail\UploadApprovedMOA;
use App\Mail\NotifyMOA;
use App\Mail\ReadyMOA;


class StudentFileController extends Controller
{
    public function viewStudentFile()
    {
        $user = Auth::user();

        $users = User::join('tbl_files', 'tbl_files.uploaded_by', '=', 'users.user_id')
                        ->join('tbl_courses', 'tbl_courses.course_id', '=', 'users.course_id')
                        ->join('tbl_file_categories', 'tbl_file_categories.category_id', '=', 'tbl_files.category_id')
                        ->get();
                        
        return view("ojt-coordinator.student-files.view-student-file", compact('users', 'user'));
    }

    public function pendingMOA()
    {   
        $user = Auth::user();

        $users = Moa_Files::join('users', 'users.user_id', '=', 'tbl_moa_files.uploaded_by')
                        ->join('tbl_courses', 'tbl_courses.course_id', '=', 'users.course_id')
                        ->where('adviser_approval', '=', 'approved')
                        ->where('signed_approval', '=', 'unprocessed')
                        ->get();

        return view("ojt-coordinator.student-files.pending-moa", compact('users', 'user'));
    }

    public function readiedMOA()
    {
        $user = Auth::user();

        $users = Moa_Files::join('users', 'users.user_id', '=', 'tbl_moa_files.uploaded_by')
                            ->join('tbl_courses', 'tbl_courses.course_id', '=', 'users.course_id')
                            ->where('adviser_approval', '=', 'approved')
                            ->where('signed_approval', '=', 'approved')
                            ->get();
                            
        return view("ojt-coordinator.student-files.ready-moa", compact('users', 'user'));
    }

    public function approvedMOA()
    {
        $user = Auth::user();

        $users = Moa_Files::join('users', 'users.user_id', '=', 'tbl_moa_files.uploaded_by')
                            ->join('tbl_courses', 'tbl_courses.course_id', '=', 'users.course_id')
                            ->where('adviser_approval', 'approved')
                            ->where('signed_approval', 'approved')
                            ->where('notary_approval', 'approved')
                            ->where('ojt_coordinator_approval', 'approved')
                            ->get();
                            
        return view("ojt-coordinator.student-files.approved-moa", compact('users', 'user'));
    }

    public function disapprovedMOA()
    {
        $user = Auth::user();

        $users = Moa_Files::join('users', 'users.user_id', '=', 'tbl_moa_files.uploaded_by')
                        ->join('tbl_courses', 'tbl_courses.course_id', '=', 'users.course_id')
                        ->where('ojt_coordinator_approval', '=', 'disapproved')
                        ->get();
        return view("ojt-coordinator.student-files.disapproved-moa", compact('users', 'user'));
    }

    public function readyMoa($id)
    {
        $data = Moa_Files::where('uploaded_by', $id)->first();
        $user_id = $data['uploaded_by'];
        $user = User::where('user_id', '=', $user_id)->first();
        $users = Auth::user();

        if($user)
        {
            Mail::send(new ReadyMOA($user, $users));

            Moa_Files::where('uploaded_by', $id)->update([
                'signed_approval' => 'approved',
            ]);

            toast('Success!','success');

            return redirect()->back();
        }
        else
        {
            toast('Something went wrong!','error');

            return redirect()->back();
        }
    }

    public function disapproveMoa(Request $request, $id)
    {
        $data = Moa_Files::where('uploaded_by', $id)->first();
        $user_id = $data['uploaded_by'];
        $user = User::where('user_id', '=', $user_id)->first();
        $users = Auth::user();
        $remarks = $request->remarks;

        if($data)
        {
            Mail::send(new DisapprovedMOA($user, $users, $remarks));

            Moa_Files::where('uploaded_by', $id)->update([
                'ojt_coordinator_approval' => 'disapproved',
            ]);

            toast('Denied successfully!','success');

            return redirect()->back();
        }
        else
        {
            toast('Something went wrong!','error');

            return redirect()->back();
        }
        
    }

    public function reupload(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'file' => 'max:20480|required'
        ]); 

        if($validated->fails())
        {
            toast('File size too large! (max: 20MB)','error');

            return redirect()->back();
        }

        $id = Files::where('file_id', $request->id)->first();
        $stud = User::where('user_id', $id->uploaded_by)->first();
        $pub = '/Files/' . $stud->first_name . '-' . $stud->last_name . '/';
        $oldname = $id->file_name;
        $path = $pub.$oldname;

        $user = Auth::user();
        $document = [];

        if ($request->hasFile('file'))
        {
            // Upload new file to student's folder
            $filename = date('YmdHi') . $request->file->getClientOriginalName();
            $destinationPath = public_path(). '/Files/' . $stud->first_name . '-' . $stud->last_name . '/';
            $request->file->move($destinationPath, $filename);

            // Update file in database
            $dateToday = date('Y-m-d H:i'); 
            $files = new Files();
            $studId = $stud->user_id;
            $email = $stud->email;

            Files::where('file_id', $id->file_id)->update([
                'file_name' => $filename,
                'file_path' => $destinationPath,
                'date_uploaded' => $dateToday,
                'uploaded_by' => $stud->user_id,
                'notary_approval' => 'approved',
            ]);

            Moa_Files::where('file_name', $id->file_name)->update([
                'file_name' => $filename,
                'file_path' => $destinationPath,
                'date_uploaded' => $dateToday,
                'uploaded_by' => $stud->user_id,
                'notary_approval' => 'approved',
            ]);

            $document[] = $filename;

            // Delete old file
            if (File::exists(public_path($path)))
            {
                File::delete(public_path($path));
            }

            Mail::send(new UploadApprovedMOA($email));
            
            toast('Uploaded successfully!','success');

            return redirect()->back();
        }
        else
        {
            toast('Something went wrong!','error');

            return redirect()->back();
        }
    }

    public function downloadFile($id, $file)
    {
        $user = User::where('user_id', $id)->first();
        $fileName = Files::where('uploaded_by', $id)->where('file_name', $file)->get(['file_name']);

        foreach($fileName as $name)
        {
            if (File::exists(public_path('Files/' . $user->first_name . '-' . $user->last_name . '/'. $name['file_name'])))
            {
                return response()->download(public_path('Files/' . $user->first_name . '-' . $user->last_name . '/'. $name['file_name']));

                return redirect()->back();
            }
            else
            {
                toast('File does not exist!','error');

                return redirect()->back();
            }
        }
    }

    public function notify(Request $request, $id)
    {
        $stud = User::where('user_id', $id)->first();
        if($stud)
        {
            Mail::to($stud->email)->send(new NotifyMOA());

            Files::where('uploaded_by', $id)
                    ->where('file_name', $request->file_name)
                    ->update([
                        'notary_approval' => 'approved',
                    ]);

            Moa_Files::where('uploaded_by', $id)
                    ->where('file_name', $request->file_name)
                    ->update([
                        'notary_approval' => 'approved',
                        'ojt_coordinator_approval' => 'approved',
                    ]);

            toast('Success!','success');

            return redirect()->back();
        }
        else
        {
            toast('Something went wrong!','error');

            return redirect()->back();
        }
    }
}
