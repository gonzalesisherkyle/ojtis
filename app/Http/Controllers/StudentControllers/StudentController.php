<?php

namespace App\Http\Controllers\StudentControllers;

use App\Http\Controllers\Controller;
use App\Models\Announcements;
use App\Models\Room_Students;
use App\Models\Rooms;
use App\Models\Student_Approval;
use App\Models\Student;
use App\Models\User;
use App\Models\MoaList;
use App\Models\OJTInfo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;

class StudentController extends Controller
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

        $adv = Student::where('email', $user->email)->first();

        $announcements = Announcements::join('tbl_rooms','tbl_rooms.room_id','=','tbl_announcements.room_id')
                                        ->join('tbl_room_students', 'tbl_room_students.room_id', '=', 'tbl_rooms.room_id')
                                        ->join('users','users.user_id','=','tbl_announcements.from')
                                        ->where('adviser_id', $adv->adviser_id)
                                        ->where('student_id', $user->user_id)
                                        ->get();
                                
        return view('student.home', compact('user', 'announcements'));
    }

    public function account()
    {
        $users = Auth::user();
        $user = User::where('user_id', $users->user_id)
                    ->first();


        return view('student.account', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $stud = Student::where('email', $user->email)->first();

        $request->validate([            
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => [ 'nullable','max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'suffix' => ['nullable'],
            'address' => ['required','string'],
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->ignore($user->user_id,'user_id')],
            'student_number' => ['nullable', 'string', 'max:50', Rule::unique('users')->ignore($user->user_id,'user_id')],
            'year_and_section' => ['nullable', 'string', 'max:255'],
            'course_id' => ['nullable', 'string'],
            'contact_number' => ['required', 'string'],
            'date_of_birth' => ['required', 'date'],
        ]);

        Student::where('student_id', $stud->user_id)->update([

            'first_name' => $request['first_name'],
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            'suffix' => $request['suffix'],
            'email' => $request['email'],
            'student_number' =>$request['student_number'],
            'year_and_section' => $request['year_and_section'],
            'course_id' => $request['course_id'],
            'contact_number' => $request['contact_number'],
            'address' => $request['address'],
            'date_of_birth' => $request['date_of_birth'],
        ]);

        User::where('user_id', $user->user_id)->update([

            'first_name' => $request['first_name'],
            'middle_name' => $request['middle_name'],
            'last_name' => $request['last_name'],
            'suffix' => $request['suffix'],
            'email' => $request['email'],
            'student_number' =>$request['student_number'],
            'year_and_section' => $request['year_and_section'],
            'course_id' => $request['course_id'],
            'contact_number' => $request['contact_number'],
            'address' => $request['address'],
            'date_of_birth' => $request['date_of_birth'],
        ]);

        toast('Updated successfully!','success');

        return redirect()->back();
    }

    public function myRooms()
    {
        $user = Auth::user();
           
        $adv= Student::where('email', $user->email)
                        ->first();

        $rooms = Rooms::join('tbl_courses','tbl_courses.course_id','=','tbl_rooms.course_id')
                    // ->join('tbl_students_approval', 'tbl_students_approval.room_id', '=', 'tbl_rooms.room_id')
                    ->join('users', 'users.user_id', '=', 'tbl_rooms.adviser_id')
                    ->where('adviser_id', $adv->adviser_id)
                    // ->where('student_id', $user->user_id)
                    ->get();

        $adviser = User::where('user_id', $adv->adviser_id)->first();

        $myRooms = Room_Students::join('tbl_rooms','tbl_rooms.room_id','=','tbl_room_students.room_id')
                                ->where('student_id', Auth::id())
                                ->get();   

        return view('student.room-application.index', compact('user', 'rooms', 'myRooms', 'adviser'));
    }

    public function joinRoom($id)
    {
        $room = Rooms::find($id);
        $user = Auth::user();

        $getAllPendingApproval =  Student_Approval::where('room_id', $id)
                                                ->where('approval_status', 'pending')
                                                ->get();
        $getAllAcceptedApproval =  Student_Approval::where('room_id', $id)
                                                ->where('approval_status', 'accepted')
                                                ->get();
        $getAllDeclinedApproval =  Student_Approval::where('room_id', $id)
                                                ->where('approval_status', 'declined')
                                                ->get();
        if($room)
        {
            if($getAllPendingApproval->isNotEmpty())
            {
                foreach($getAllPendingApproval as $approval)
                {
                    if($id == $approval->room_id && $approval->student_id == $user->user_id && $approval->approval_status == 'pending')
                    {   
                        toast('You have a pending application!','error');

                        return redirect()->back();
                    }
                }  
            }
            
            if($getAllAcceptedApproval->isNotEmpty())
            {
                foreach($getAllAcceptedApproval as $approved)
                {
                    if($id == $approved->room_id && $approved->student_id == $user->user_id && $approved->approval_status == 'accepted')
                    {
                        toast('You are already in this room!','error');

                        return redirect()->back();
                    }
                }
            }
            
            if($getAllDeclinedApproval->isNotEmpty())
            {
                foreach($getAllDeclinedApproval as $declined)
                {
                    if($id == $declined->room_id && $declined->student_id == $user->user_id &&  $declined->approval_status == 'declined')
                    {
                        toast('You have been declined access to this room!','error');

                        return redirect()->back();
                    }
                }
            }
 
            Student_Approval::create([
                'student_id' => $user->user_id,
                'room_id' => $id,
                'approval_status' => 'pending',
            ]);

            toast('Wait for approval!','success');

            return redirect()->back();

        }
        else
        {
            toast('Something went wrong!','error');

            return redirect()->back();
        }
        
    }   

    public function moalist()
    {
        $user = Auth::user();

        $moa = MoaList::all();

        return view('student.moa-list', compact('moa', 'user'));
    }

    public function ojtInfo()
    {
        $user = Auth::user();

        $info = OJTInfo::where('student_id', Auth::id())->first();

        return view('student.ojt-info', compact('user','info'));
    }

    public function infoUpdate(Request $request)
    {
        $check = OJTInfo::where('student_id', Auth::id())->first();

        if($check == null)
        {
            $info = OJTInfo::create([
                'student_id' => Auth::id(),
                'company_name' => $request->company_name,
                'company_address' => $request->company_address,
                'nature_of_bus' => $request->nature_of_bus,
                'nature_of_link' => $request->nature_of_link,
                'level' => $request->level,
                'start_date' => $request->start_date,
                'finish_date' => $request->finish_date,
                'report_time' => $request->report_time,
                'contact_name' => $request->contact_name,
                'contact_position' => $request->contact_position,
                'contact_number' => $request->contact_number,
            ]);

            toast('Updated successfully!','success');

            return redirect()->back();
        }

        $info = OJTInfo::where('student_id', Auth::id())->update([
            'student_id' => Auth::id(),
            'company_name' => $request->company_name,
            'company_address' => $request->company_address,
            'nature_of_bus' => $request->nature_of_bus,
            'nature_of_link' => $request->nature_of_link,
            'level' => $request->level,
            'start_date' => $request->start_date,
            'finish_date' => $request->finish_date,
            'report_time' => $request->report_time,
            'contact_name' => $request->contact_name,
            'contact_position' => $request->contact_position,
            'contact_number' => $request->contact_number,
        ]);

        toast('Updated successfully!','success');

            return redirect()->back();
    }
}
