<?php

namespace App\Http\Controllers\StudentControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Files;
use App\Models\File_Categories;
use App\Models\Moa_Files;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Response;
use App\Mail\ApprovalRL;
use App\Mail\ApprovalMOA;

class UploadController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $id = $user->user_id;

        $files = Files::join('tbl_file_categories', 'tbl_file_categories.category_id', '=', 'tbl_files.category_id')
                        ->where('uploaded_by','=', $id )
                        ->get();

        return view("student.uploading.upload", compact('files','user'));
    }

    public function fileStudent()
    {
        $user = Auth::user();
        $id = $user->user_id;

        $files = Files::join('tbl_file_categories', 'tbl_file_categories.category_id', '=', 'tbl_files.category_id')
                        ->join('tbl_moa_files', 'tbl_moa_files.file_name', '=', 'tbl_files.file_name')
                        ->where('uploaded_by','=', $id )
                        ->get();
        return view("student.uploading.view-file", compact('files', 'user'));
    }
    
    public function importStudents(Request $request)
    {
        $user = Auth::user();
        $validated = Validator::make($request->all(), [
            'file.*' => 'max:20480|required'
        ]); 

        if($validated->fails())
        {
            toast('File size too large! (max: 20MB)','error');

            return redirect()->back();
        }

        $adviser = Student::where('email', $user->email)->first();
        $adviserEmail = User::where('user_id', $adviser->adviser_id)->first();
        $document = [];
        $categoryArray = $request->category_id;
        $fileArray = $request->file('file');
        
        if ($request->hasFile('file'))
        {
            foreach(array_combine($categoryArray, $fileArray) as $category => $file)
            {
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $destinationPath = public_path(). '/Files/' . $user->first_name . '-' . $user->last_name . '/';
                $file->move($destinationPath, $filename);

                $dateToday = date('Y-m-d H:i'); 
                $files = new Files();
                $id = $user->user_id;

                if($category == 8)
                {
                    Mail::to($adviserEmail->email)->send(new ApprovalRL($user));
                }
                
                if($category == 9)
                {
                    $moa = new Moa_Files();
                    $moa->file_name = $filename;
                    $moa->file_path = $destinationPath;
                    $moa->date_uploaded = $dateToday;
                    $moa->uploaded_by = $id;
                    $document[] = $filename;
                    Mail::to($adviserEmail->email)->send(new ApprovalMOA($user));
                    $moa->save();
                }


                $files->category_id = $category;
                $files->file_name = $filename;
                $files->file_path = $destinationPath;
                $files->date_uploaded = $dateToday;
                $files->uploaded_by = $id;
                $document[] = $filename;
                $files->save();
            }     
        }
        toast('Uploaded successfully!','success');

        return redirect()->back();
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

        $user = Auth::user();
        $id = Files::where('file_id', $request->id)->first();
        $pub = '/Files/' . $user->first_name . '-' . $user->last_name . '/';
        $oldname = $id->file_name;
        $path = $pub.$oldname;

        $document = [];

        if ($request->hasFile('file'))
        {
            // Upload new file to student's folder
            $filename = date('YmdHi') . $request->file->getClientOriginalName();
            $destinationPath = public_path(). '/Files/' . $user->first_name . '-' . $user->last_name . '/';
            $request->file->move($destinationPath, $filename);

            // Update file in database
            $dateToday = date('Y-m-d H:i'); 
            $files = new Files();

            Files::where('file_id', $id->file_id)->update([
                'file_name' => $filename,
                'file_path' => $destinationPath,
                'date_uploaded' => $dateToday,
                'uploaded_by' => $user->user_id,
            ]);

            Moa_Files::where('file_name', $id->file_name)->update([
                'file_name' => $filename,
                'file_path' => $destinationPath,
                'date_uploaded' => $dateToday,
                'uploaded_by' => $user->user_id,
            ]);

            $document[] = $filename;

            // Delete old file
            if (File::exists(public_path($path)))
            {
                File::delete(public_path($path));
            }
            
            toast('Uploaded successfully!','success');

            return redirect()->back();
        }
        else
        {
            toast('Something went wrong!','error');

            return redirect()->back();
        }
    }

    public function removeFile($id)
    {
        $user = Auth::user();

        $file = Files::where('file_id', $id)->first();
        $pub = '/Files/' . $user->first_name . '-' . $user->last_name . '/';
        $filename = $file->file_name;
        $path = $pub.$filename;

        if (File::exists(public_path($path))) 
        {
            Files::where('file_id', $id)->delete();

            if($file->category_id == 9)
            {
                Moa_Files::where('uploaded_by', $user->user_id)->delete();
            }

            File::delete(public_path($path));

            Alert::success('Success', 'Remove successfully');

            return redirect()->back();
        }
        else
        {
            Alert::error('Error', 'File does not exist!');

            return redirect()->back();
        }
    }
    
}
