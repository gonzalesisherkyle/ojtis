<?php

namespace App\Http\Controllers\AdviserControllers;

use App\Http\Controllers\Controller;
use App\Models\Announcements;
use App\Models\Files;
use App\Models\Moa_Files;
use App\Models\Room_Students;
use App\Models\Rooms;
use App\Models\Student_Approval;
use App\Models\Student;
use App\Models\MoaList;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use App\Models\Register;
use App\Models\OJTInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File; 
use RealRashid\SweetAlert\Facades\Alert;
use App\Mail\ApprovedRL;
use App\Mail\ApprovalRL;
use App\Mail\ApprovalMOA;
use App\Mail\DisapprovedRL;
use App\Mail\ApprovedMOA;   
use App\Mail\DisapprovedMOA;
use App\Mail\NewStudent;
use App\Mail\NotifyRL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class AdviserController extends Controller
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

        $account = Register::join('tbl_courses', 'tbl_courses.course_id', '=', 'registers.course_id')
                        ->where('adviser_id', Auth::id())
                        ->where('status', 'pending')
                        ->get();

        $students = Student::where('adviser_id', $user->user_id)->get();

        $moa = Moa_Files::join('users', 'users.user_id' ,'=','tbl_moa_files.uploaded_by')
                        ->join('tbl_students', 'tbl_students.email', '=', 'users.email')
                        ->join('tbl_room_students', 'tbl_room_students.student_id', '=', 'users.user_id')
                        ->where('adviser_id', $user->user_id)
                        ->where('adviser_approval','unprocessed')
                        ->get();

        $pending = Student_Approval::join('tbl_rooms','tbl_rooms.room_id','=','tbl_students_approval.room_id')
                        ->join('users','users.user_id','=','tbl_students_approval.student_id')
                        ->where('tbl_rooms.adviser_id', Auth::id())
                        ->where('approval_status','=','pending')->get();

        $letter = Files::join('users','users.user_id' ,'=','tbl_files.uploaded_by')
                        ->join('tbl_students', 'tbl_students.email', '=', 'users.email')
                        ->join('tbl_room_students', 'tbl_room_students.student_id', '=', 'users.user_id')
                        ->where('adviser_id', $user->user_id)
                        ->where('adviser_approval','unprocessed')
                        ->where('tbl_files.category_id',8 )
                        ->get();

        $appmoa = Moa_Files::join('users', 'users.user_id' ,'=','tbl_moa_files.uploaded_by')
                        ->join('tbl_students', 'tbl_students.email', '=', 'users.email')
                        ->join('tbl_room_students', 'tbl_room_students.student_id', '=', 'users.user_id')
                        ->where('adviser_id', $user->user_id)
                        ->where('adviser_approval','approved')
                        ->get();

        $appletter = Files::join('users','users.user_id' ,'=','tbl_files.uploaded_by')
                        ->join('tbl_students', 'tbl_students.email', '=', 'users.email')
                        ->join('tbl_courses', 'tbl_courses.course_id', '=', 'tbl_students.course_id')
                        ->where('adviser_id', $user->user_id)
                        ->where('adviser_approval','approved')
                        ->where('signed_approval','approved')
                        ->where('tbl_files.category_id',8 )
                        ->get();
    
        return view('adviser.home', compact('user', 'account', 'students', 'moa', 'letter', 'appmoa', 'appletter', 'pending'));
    }

    public function account()
    {
        $user = Auth::user();

        return view('adviser.account', compact('user'));
    }

    public function studentacc($id)
    {
        $user = Auth::user();
        $info = OJTInfo::where('student_id', $id)->first();
        $users = Student::where('student_id', $id)->first();

        return view('adviser.students.view-student', compact('users', 'user', 'info'));
    }

    public function studentfile($id)
    {
        $user = Auth::user();
        $student = User::where('user_id', $id)->first();

        $files = Files::join('tbl_file_categories', 'tbl_file_categories.category_id', '=', 'tbl_files.category_id')
                    ->where('uploaded_by', $id)
                    ->get();

        return view('adviser.students.view-student-file', compact('files', 'student', 'user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([            
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => [ 'nullable','max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable'],
            'address' => ['required','string'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($user->user_id,'user_id')],
            'contact_number' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
        ]);

        User::where('user_id', $user->user_id)->update([

            'first_name' => $request['first_name'],
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            'suffix' => $request['suffix'],
            'email' => $request['email'],
            'contact_number' => $request['contact_number'],
            'address' => $request['address'],
            'date_of_birth' => $request['date_of_birth'],
        ]);

        toast('Updated successfully!','success');

        return redirect()->back();
    }

    public function rooms()
    {
        $user = Auth::user();

        $rooms = Rooms::join('tbl_courses', 'tbl_courses.course_id','=','tbl_rooms.course_id')
                    ->where('tbl_rooms.adviser_id',Auth::id())
                    ->get();

        return view('adviser.rooms.index', compact('rooms', 'user'));
    }

    public function students()
    {
        $user = Auth::user();

        $student = Student::join('tbl_courses', 'tbl_courses.course_id', '=', 'tbl_students.course_id')
                            ->where('adviser_id',Auth::id())
                            ->get();

      
        return view('adviser.students.student', compact('student', 'user'));
    }

    public function viewStudentFile()
    {
        $user = Auth::user();

        $users = User::join('tbl_files', 'tbl_files.uploaded_by', '=', 'users.user_id')
                        ->join('tbl_students', 'tbl_students.email', '=', 'users.email')   
                        ->join('tbl_courses', 'tbl_courses.course_id', '=', 'users.course_id')
                        ->join('tbl_file_categories', 'tbl_file_categories.category_id', '=', 'tbl_files.category_id')
                        ->where('adviser_id', Auth::id())
                        ->get();
                        
        return view('adviser.student-file', compact('users', 'user'));
    }

    public function create(Request $request)
    {
        $password = str::random(16);
        $email = $request['email'];
        $user_role = Roles::where('tbl_roles.role_name', 'Student')->first();

        Student::create([
            'adviser_id' => Auth::id(),
            'email' => $request['email'],
            'course_id' => $request['course_id'],
            'last_name' => $request['last_name'],
            'first_name' => $request['first_name'],
            'year_and_section' => $request['year_and_section'],
            'password' => Hash::make($password),
        ]);

        User::create([
            'email' => $request['email'],
            'course_id' => $request['course_id'],
            'last_name' => $request['last_name'],
            'first_name' => $request['first_name'],
            'year_and_section' => $request['year_and_section'],
            'password' => Hash::make($password),
            'applying_as' =>'Student',
            'status' => 'approved',
        ]);

        Register::where('email', $email)->where('adviser_id', Auth::id())->update([
            'status' => 'approved',
        ]);

        $stud = User::where('email', $email)->first();
        $stud->roles()->attach($user_role->role_id);

        Mail::send(new NewStudent($password, $email));

        toast('Approved successfully!','success');

        return redirect()->back();
    }

    public function creates(Request $request)
    {
        if($request->has('students'))
        {
            foreach($request->students as $key => $student)
            {
                $users = Register::where("reg_id", $student)->first();
                $password = str::random(16);
                $user_role = Roles::where('tbl_roles.role_name', 'Student')->first();

                Mail::send(new NewStudent($password, $users->email));

                Student::create([
                    'adviser_id' => Auth::id(),
                    'email' => $users->email,
                    'course_id' => $users->course_id,
                    'last_name' => $users->last_name,
                    'first_name' => $users->first_name,
                    'year_and_section' => $users->year_and_section,
                    'password' => Hash::make($password),
                ]);
        
                User::create([
                    'email' => $users->email,
                    'course_id' => $users->course_id,
                    'last_name' => $users->last_name,
                    'first_name' => $users->first_name,
                    'year_and_section' => $users->year_and_section,
                    'password' => Hash::make($password),
                    'applying_as' =>'Student',
                    'status' => 'approved',
                ]);
        
                Register::where('email', $users->email)->where('adviser_id', Auth::id())->update([
                    'status' => 'approved',
                ]);
        
                $stud = User::where('email', $users->email)->first();
                $stud->roles()->attach($user_role->role_id);
            }
            toast('Approved successfully!','success');
        
            return redirect()->back();
        }
        else
        {
            toast('Please select at least one. ','error');

            return redirect()->back();
        }
    }

    public function deny(Request $request)
    {
        $email = $request['email'];

        Register::where('email', $email)->where('adviser_id', Auth::id())->update([
            'status' => 'denied',
        ]);

        toast('Denied successfully!','success');

        return redirect()->back();
    }

    public function addRoom(Request $request)
    {
        $request->validate([
            'room_name' => 'required',
            'course_id' => ['required','integer']

        ]);
        // dd($request->course_id);

        Rooms::create([

            'adviser_id' => Auth::id(),
            'course_id' => $request['course_id'],
            'room_name' => $request['room_name'],
        
        ]);

        toast('Added successfully!','success');

        return redirect()->back();
    }

    public function deleteRoom($id)
    {
        if($id)
        {
            Rooms::where('room_id', $id)->delete();
            Student_Approval::where('room_id', $id)->delete();
            Room_Students::where('room_id', $id)->delete();

            toast('Removed successfully!','success');

            return redirect()->back();
        }
        else
        {
            toast('Something went wrong!','error');

            return redirect()->back();
        }
    }

    public function updateRoom(Request $request, $id)
    {
        $room = Rooms::find($id);

        if($room)
        {
            Rooms::where('room_id', $id)->update([
                'room_status' => $request['status'],
            ]);

            toast('Updated successfully!','success');

            return redirect()->back();
        }
        else
        {
            toast('Something went wrong!','error');

            return redirect()->back();
        }
    }

    public function viewRoom($id)
    {
       
        $room = Rooms::find($id);
        $user = Auth::user();

        $students = Rooms::join('tbl_room_students','tbl_room_students.room_id','=','tbl_rooms.room_id')
                        ->join('users','users.user_id','=','tbl_room_students.student_id')
                        ->where('tbl_rooms.adviser_id', Auth::id())
                        ->where('tbl_room_students.room_id', $id)                      
                        ->get();
        
        return view('adviser.rooms.view-room', compact('room', 'students', 'user'));
    }

    public function studentApproval()
    {
        $user = Auth::user();

        $students = Student_Approval::join('tbl_rooms','tbl_rooms.room_id','=','tbl_students_approval.room_id')
                                    ->join('users','users.user_id','=','tbl_students_approval.student_id')
                                    ->where('tbl_rooms.adviser_id', Auth::id())
                                    ->where('approval_status','=','pending')->get();

        return view('adviser.rooms.student-approval', compact('students', 'user'));
    }

    public function declinedStudent()
    {
        $user = Auth::user();

        $students = Student_Approval::join('tbl_rooms','tbl_rooms.room_id','=','tbl_students_approval.room_id')
                                    ->where('tbl_rooms.adviser_id', Auth::id())
                                    ->where('approval_status','=','declined')->get();

        return view('adviser.rooms.student-approval', compact('students', 'user'));
    }

    public function approveStudent($user, $id)
    {
        $student = Student_Approval::where('student_id', $user)->where('room_id', $id)->first();

        if($student)
        {
            Student_Approval::where('student_id', $user)->where('room_id', $id)->update([
                'approval_status' => 'accepted'
            ]);

            Room_Students::create([
                'room_id' => $id,
                'student_id' => $user,
                'student_status' => 'active',
            ]);

            toast('Approved successfully!','success');

            return redirect()->back();
        }else
        {
            toast('Something went wrong!','error');

            return redirect()->back();
        }
    }

    public function removeStudent($id, $room_id)
    {  
        if($id)
        {
            Student_Approval::where('student_id', $id)->where('room_id', $room_id)->delete();
            Room_Students::where('student_id', $id)->where('room_id', $room_id)->delete();

            toast('Removed successfully!','success');

            return redirect()->back();
        }
        else
        {
            toast('Something went wrong!','error');

            return redirect()->back();
        }
    }

    public function disapproveStudent($user, $id)
    {
        $student = Student_Approval::where('student_id', $user)->where('room_id', $id)->first();
        if($student)
        {
            Student_Approval::where('student_id', $user)->where('room_id', $id)->update([
                'approval_status' => 'declined'
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

    public function announcements()
    {
        $user = Auth::user();

        $announcements = Announcements::join('tbl_rooms','tbl_rooms.room_id','=','tbl_announcements.room_id')
                        ->where('from', Auth::id())
                        ->get();

        $myRooms = Rooms::where('adviser_id', Auth::id())->get();

        return view('adviser.rooms.announcements', compact('announcements', 'myRooms', 'user'));
    }

    public function newAnnouncement(Request $request)
    {
        
        $request->validate([
            'room_id' => 'required',
            'title' => 'required',
            'body' => 'required',
            'file' => 'max:10000',
        ]);

        $user = Auth::user();
        $document = [];
        $attached = new Announcements();

        if ($request->hasFile('file'))
        {
            $filename = date('YmdHi') . $request->file->getClientOriginalName();
            $desitnationPath = public_path(). '/Files/' . $user->first_name . '-' . $user->last_name . '/';
            $request->file->move($desitnationPath, $filename);

            $attached->file_name = $filename;
            $attached->file_path = $desitnationPath;
            $document[] = $filename;
        }

        $attached->room_id = $request->room_id;
        $attached->title = $request->title;
        $attached->body = $request->body;
        $attached->from = Auth::id();
        $attached->save();

        toast('Added successfully!','success');

        return redirect()->back();

    }

    public function viewannouncement($id)
    {
        $getAnnouncement = Announcements::find($id);
        $user = Auth::user();
        $announcement = Announcements::join('tbl_rooms','tbl_rooms.room_id','=','tbl_announcements.room_id')
        ->where('from', Auth::id())->get();

        if($getAnnouncement){
            return view('adviser.rooms.view-room', compact('announcement', 'user'));
        }else{
            abort(404);
        }
    }

    public function deleteAnnouncement($id)
    {
        $user = Auth::user();

        if($id)
        {
            Announcements::where('announcement_id', $id)->delete();

            toast('Removed successfully!','success');

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

            Files::where('file_id', $id->file_id)->update([
                'file_name' => $filename,
                'file_path' => $destinationPath,
                'date_uploaded' => $dateToday,
                'uploaded_by' => $stud->user_id,
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

    public function rlApproval()
    {
        $user = Auth::user();

        $rLetters = Files::join('users','users.user_id' ,'=','tbl_files.uploaded_by')
                        ->join('tbl_students', 'tbl_students.email', '=', 'users.email')
                        ->join('tbl_room_students', 'tbl_room_students.student_id', '=', 'users.user_id')
                        ->join('tbl_courses', 'tbl_courses.course_id', '=', 'tbl_students.course_id')
                        ->where('adviser_id', $user->user_id)
                        ->where('adviser_approval','unprocessed')
                        ->where('tbl_files.category_id',8 )
                        ->get();

        return view('adviser.approval.recommendation-letters', compact('rLetters', 'user'));
    }
 
    public function clearRL($id)
    {
        $rLetter = Files::find($id);
        $user_id = $rLetter['uploaded_by'];
        $user = User::where('user_id', '=', $user_id)->first();
        $users = Auth::user();
        $email = User::where('applying_as', 'Head of Academics Program')
        ->where('status', 'approved')
        ->first();

        if($rLetter)
        {
            Mail::send(new ApprovedRL($user, $users));
            
            Files::where('file_id', $id)->update([
                'adviser_approval' => 'approved'
            ]);

            toast('Approved successfully!','success');

            return redirect()->back();
        }
        else
        {   
            toast('Something went wrong!','error');

            return redirect()->back();
        }
        
    }

    public function rejectRL(Request $request, $id)
    {
        $rLetter = Files::find($id);
        $user_id = $rLetter['uploaded_by'];
        $user = User::where('user_id', '=', $user_id)->first();
        $users = Auth::user();
        $remarks = $request->remarks;

        if($rLetter)
        {

            Mail::send(new DisapprovedRL($user, $users, $remarks));

            Files::where('file_id', $id)->update([
                'adviser_approval' => 'disapproved'
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
    
    public function moaApproval()
    {
        $user = Auth::user();

        $moa_files = Moa_Files::join('users', 'users.user_id' ,'=','tbl_moa_files.uploaded_by')
                        ->join('tbl_students', 'tbl_students.email', '=', 'users.email')
                        ->join('tbl_room_students', 'tbl_room_students.student_id', '=', 'users.user_id')
                        ->join('tbl_courses', 'tbl_courses.course_id', '=', 'tbl_students.course_id')
                        ->where('adviser_id', $user->user_id)
                        ->where('adviser_approval','unprocessed')
                        ->get();

        return view('adviser.approval.moa-files', compact('moa_files', 'user'));
    }

    public function clearMoa($id)
    {
        $moa = Moa_Files::find($id);
        $user_id = $moa['uploaded_by'];
        $user = User::where('user_id', '=', $user_id)->first();
        $filename = $moa['file_name'];
        $users = Auth::user();
        $ojt = User::where('applying_as', 'OJT Coordinator')->first();
        if($moa)
        {
            Mail::send(new ApprovedMOA($user, $users));
            Mail::to($ojt->email)->send(new ApprovalMOA($user));

            Files::where('file_name', $filename)->update([
                'adviser_approval' => 'approved'
            ]);

            Moa_Files::where('file_id', $id)->update([
                'adviser_approval' => 'approved'
            ]);

            toast('Approved successfully!','success');

            return redirect()->back();
        }
        else
        {
            toast('Something went wrong!','error');

            return redirect()->back();
        }
        
    }

    public function rejectMoa(Request $request, $id)
    {
        $moa = Moa_Files::find($id);
        $user_id = $moa['uploaded_by'];
        $user = User::where('user_id', '=', $user_id)->first();
        $users = Auth::user();
        $remarks = $request->remarks;
        
        if($moa)
        {
            Mail::send(new DisapprovedMOA($user, $users, $remarks));

            Files::where('file_id', $id)->update([
                'adviser_approval' => 'disapproved'
            ]);

            Moa_Files::where('file_id', $id)->update([
                'adviser_approval' => 'disapproved'
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

    public function approvedMoa()
    {
        $user = Auth::user();

        $moa_files = Moa_Files::join('users', 'users.user_id' ,'=','tbl_moa_files.uploaded_by')
                            ->join('tbl_students', 'tbl_students.email', '=', 'users.email')
                            ->join('tbl_courses', 'tbl_courses.course_id', '=', 'tbl_students.course_id')
                            ->where('adviser_id', $user->user_id)
                            ->where('adviser_approval','approved')
                            ->get();
        
        return view('adviser.reports.moa-files-approved', compact('moa_files', 'user'));
    }

    public function approvedRL()
    {
        $user = Auth::user();

        $files = Files::join('users','users.user_id' ,'=','tbl_files.uploaded_by')
                    ->join('tbl_students', 'tbl_students.email', '=', 'users.email')
                    ->join('tbl_courses', 'tbl_courses.course_id', '=', 'tbl_students.course_id')
                    ->where('adviser_id', $user->user_id)
                    ->where('adviser_approval','approved')
                    ->where('signed_approval','approved')
                    ->where('tbl_files.category_id',8 )
                    ->get();
        
        return view('adviser.reports.recommendation-letter-approved', compact('files', 'user'));
    }

    public function disapprovedMoa()
    {
        $user = Auth::user();

        $moa_files = Moa_Files::join('users', 'users.user_id' ,'=','tbl_moa_files.uploaded_by')
                            ->join('tbl_students', 'tbl_students.email', '=', 'users.email')
                            ->join('tbl_room_students', 'tbl_room_students.student_id', '=', 'users.user_id')
                            ->join('tbl_courses', 'tbl_courses.course_id', '=', 'tbl_students.course_id')
                            ->where('adviser_id', $user->user_id)
                            ->where('adviser_approval','disapproved')
                            ->get();
        
        return view('adviser.reports.moa-files-denied', compact('moa_files', 'user'));
    }

    public function disapprovedRL()
    {
        $user = Auth::user();

        $files = Files::join('users','users.user_id' ,'=','tbl_files.uploaded_by')
                    ->join('tbl_students', 'tbl_students.email', '=', 'users.email')
                    ->join('tbl_room_students', 'tbl_room_students.student_id', '=', 'users.user_id')
                    ->join('tbl_courses', 'tbl_courses.course_id', '=', 'tbl_students.course_id')
                    ->where('adviser_id', $user->user_id)
                    ->where('adviser_approval','disapproved')
                    ->where('tbl_files.category_id',8 )
                    ->get();
        
        return view('adviser.reports.recommendation-letter-denied', compact('files', 'user'));
    }

    public function notify(Request $request, $id)
    {   
        $stud = User::where('user_id', $id)->first();

        if($stud)
        {
            Mail::to($stud->email)->send(new NotifyRL());

            Files::where('file_name', $request->file_name)->update([
                'signed_approval' => 'approved',
            ]);

            toast('Notified successfully!','success');

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

    public function moalist()
    {
        $user = Auth::user();

        $moa = MoaList::all();

        return view('adviser.moa-list', compact('moa', 'user'));
    }

    public function addcompany(Request $request)
    {
        $request->validate([
            'company_name' => 'required|string',
            'company_address' => 'required|string',
            'contact_person' => 'required|string',
            'position' => 'required|string',
        ]);

        MoaList::create([
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'company_contact_person' => $request->contact_person,
            'company_contact_person_position' => $request->position,
        ]);

        toast('Added successfully!','success');

        return redirect()->back();
    }

    public function updatecompany(Request $request, $id)
    {
        $request->validate([
            'company_name' => 'required|string',
            'company_address' => 'required|string',
            'contact_person' => 'required|string',
            'position' => 'required|string',
        ]);

        MoaList::where('company_id', $id)->update([
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'company_contact_person' => $request->contact_person,
            'company_contact_person_position' => $request->position,
        ]);

        toast('Updated successfully!','success');

        return redirect()->back();
    }

    public function removecompany($id)
    {
        if($id)
        {
            MoaList::where('company_id', $id)->delete();

            toast('Removed successfully!','success');

            return redirect()->back();
        }
        else
        {
            toast('Something went wrong!','error');

            return redirect()->back();
        }
    }

    public function pendingStudents()
    {
        $user = Auth::user();

        $pending = Register::join('tbl_courses', 'tbl_courses.course_id', '=', 'registers.course_id')
                            ->where('adviser_id', Auth::id())
                            ->where('status', 'pending')
                            ->get();

        return view('adviser.students.approval', compact('user', 'pending'));
    }

    public function updateRecord(Request $request)
    {
        $id = $request->input('id');
        $isChecked = $request->input('status');

        Files::where('file_id', $id)->update([
            'status' => $isChecked,
        ]);
    
        toast('Success!','success');

        return redirect()->back();
    }

    public function signature()
    {
        $user = Auth::user();

        $files = Files::join('users','users.user_id' ,'=','tbl_files.uploaded_by')
                    ->join('tbl_students', 'tbl_students.email', '=', 'users.email')
                    ->join('tbl_courses', 'tbl_courses.course_id', '=', 'tbl_students.course_id')
                    ->where('adviser_id', $user->user_id)
                    ->where('adviser_approval','approved')
                    ->where('signed_approval','unprocessed')
                    ->where('tbl_files.category_id',8 )
                    ->get();
        
        return view('adviser.reports.pending', compact('user', 'files'));
    }
}
