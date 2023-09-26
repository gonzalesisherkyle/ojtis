<?php

namespace App\Http\Controllers\SuperadminControllers;

use App\Http\Controllers\Controller;
use App\Models\File_Categories;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class SuperadminController extends Controller
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

        $users = User::where('applying_as', '!=', 'Super Admin')->get();

        $students = User::where('applying_as', 'Student')->get();

        $advisers = User::where('applying_as', 'Adviser')->get();

        $coord = User::where('applying_as', 'OJT Coordinator')->get();

        return view('superadmin.home', compact('user', 'users', 'students', 'advisers', 'coord'));
    }

    public function categories()
    {
        $user = Auth::user();
        $categories = File_Categories::all();

        return view('superadmin.categories.index', compact('categories', 'user'));
    }
    
    public function storeCategory(Request $request)
    {   
        $request->validate([
            'category_name' => 'required',
        ]);

        File_Categories::create([
            'category_name' => $request['category_name']
        ]);

        toast('Added successfully!','success');

        return redirect()->back();
        
    }

    public function updateCategory(Request $request, $id)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        File_Categories::where('category_id', $id)->update([
            'category_name' => $request['category_name']
        ]);

        toast('Updated successfully!','success');

        return redirect()->back();
        
    }

    public function deleteCategory($id)
    {
        if($id)
        {
            File_Categories::where('category_id', $id)->delete();

            toast('Removed successfully!','success');

            return redirect()->back();
        }
        else
        {
            toast('Something went wrong!','error');

            return redirect()->back();
        }
    }

    public function courses()
    {
        $user = Auth::user();

        $courses = Course::all();
        return view('superadmin.courses.course', compact('courses', 'user'));
    }

    public function storeCourse(Request $request)
    {   
        $request->validate([
            'course_name' => 'required',
            'course_abb' => 'required',
        ]);

        Course::create([
            'course_name' => $request['course_name'],
            'course_abb' => $request['course_abb']
        ]);

        toast('Added successfully!','success');

        return redirect()->back();
        
    }

    public function updateCourse(Request $request, $id)
    {
        $request->validate([
            'course_name' => 'required',
            'course_abb' => 'required'
        ]);

        Course::where('course_id', $id)->update([
            'course_name' => $request['course_name'],
            'course_abb' => $request['course_abb']
        ]);

        toast('Updated successfully!','success');

        return redirect()->back();
        
    }
    
    public function deleteCourse($id)
    {
        if($id)
        {
            Course::where('course_id', $id)->delete();

            toast('Removed successfully!','success');

            return redirect()->back();
        }
        else
        {
            toast('Something went wrong!','error');

            return redirect()->back();
        }
    }
}
