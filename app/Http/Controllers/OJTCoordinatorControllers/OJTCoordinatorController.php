<?php

namespace App\Http\Controllers\OJTCoordinatorControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Student;
use App\Models\Files;
use App\Models\Moa_Files;
use App\Models\MoaList;
use App\Models\Roles;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use App\Mail\NewStudent;

class OJTCoordinatorController extends Controller
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

        $advisers = User::where('applying_as', 'Adviser')->get();

        $students = Student::all();

        $pending = Moa_Files::where('adviser_approval', '=', 'approved')
                        ->where('ojt_coordinator_approval', '=', 'unprocessed')
                        ->get();

        $appmoa = Moa_Files::join('users', 'users.user_id', '=', 'tbl_moa_files.uploaded_by')
                            ->join('tbl_courses', 'tbl_courses.course_id', '=', 'users.course_id')
                            ->where('adviser_approval', 'approved')
                            ->where('signed_approval', 'approved')
                            ->where('notary_approval', 'approved')
                            ->where('ojt_coordinator_approval', 'approved')
                            ->get();

        return view("ojt-coordinator.home", compact('user', 'advisers', 'students', 'pending', 'appmoa'));
    }

    public function account()
    {
        $user = Auth::user();

        return view('ojt-coordinator.account', compact('user'));
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

    public function students()
    {
        $user = Auth::user();

        $student = User::join('tbl_courses', 'tbl_courses.course_id','=','users.course_id')
                            ->where('applying_as', 'Student')
                            ->get();

        return view("ojt-coordinator.students.student", compact('student', 'user'));
    }

    public function advisers()
    {
        $user = Auth::user();

        $adviser = User::where('applying_as', 'Adviser')
                        ->where('email', '!=', null)
                        ->get();

        return view("ojt-coordinator.advisers.adviser", compact('adviser', 'user'));
    }

    public function studentacc($id)
    {
        $user = Auth::user();
        $users = User::where('user_id', $id)->first();

        return view('ojt-coordinator.students.view-student', compact('user', 'users'));
    }

    public function studentfile($id)
    {
        $user = Auth::user();
        $student = User::where('user_id', $id)->first();

        $files = Files::join('tbl_file_categories', 'tbl_file_categories.category_id', '=', 'tbl_files.category_id')
                    ->join('users', 'users.user_id', '=', 'tbl_files.uploaded_by')
                    ->where('uploaded_by', $id)
                    ->get();

        return view('ojt-coordinator.students.view-student-file', compact('files', 'student', 'user'));
    }

    public function adviseracc($id)
    {
        $user = Auth::user();
        $users = User::where('user_id', $id)->first();

        return view('ojt-coordinator.advisers.view-adviser', compact('user', 'users'));
    }

    public function moalist()
    {
        $user = Auth::user();

        $moa = MoaList::all();

        return view('ojt-coordinator.moa-list', compact('moa', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
        
        $password = str::random(16);
        $email = $request['email'];
        $user_role = Roles::where('tbl_roles.role_name', 'Adviser')->first();

        $user = User::create([
            'email' => $request['email'],
            'password' => Hash::make($password),
            'applying_as' => 'Adviser',
            'status' => 'approved',
        ]);

        $user = User::where('email', $email)->first();
        $user->roles()->attach($user_role->role_id);

        Mail::send(new NewStudent($password, $email));

        toast('Added successfully!','success');

        return redirect()->back();

    }

    public function downloadable()
    {
        $user = Auth::user();
        $files = Files::where('uploaded_by', Auth::id());

        return view('ojt-coordinator.downloadable', compact('user', 'files'));
    }

    public function upload(Request $request)
    {
        dd($request);
    }
}
