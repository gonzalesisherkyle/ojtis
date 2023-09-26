<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdviserControllers\AdviserController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentControllers\StudentController;
use App\Http\Controllers\StudentControllers\UploadController;
use App\Http\Controllers\SuperadminControllers\SuperadminController;
use App\Http\Controllers\OJTCoordinatorControllers\OJTCoordinatorController;
use App\Http\Controllers\OJTCoordinatorControllers\StudentFileController;
use App\Http\Controllers\SuperadminControllers\UserController;
use App\Http\Controllers\SuperadminControllers\UserVerficationController;
use App\Http\Controllers\HeadOfAcademicsProgramControllers\HeadOfAcademicsProgramController;
use App\Http\Controllers\DirectorControllers\DirectorController;
use App\Http\Controllers\ChangePasswordController;
use App\Models\Files;
use App\Models\Moa_Files;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    
    if (auth()->check())
    {   
        $user = Auth::user();
        if (($user->roles->pluck('role_name'))->containsStrict('Student'))
        {
            return redirect()->route('student-home');
        }
        else if (($user->roles->pluck('role_name'))->containsStrict('Super Admin'))
        {
            return redirect()->route('superadmin-home');
        }
        else if (($user->roles->pluck('role_name'))->containsStrict('Adviser'))
        {
            return redirect()->route('adviser-home');
        }
        else if (($user->roles->pluck('role_name'))->containsStrict('OJT Coordinator'))
        {
            return redirect()->route('ojt-coordinator-home');
        } 
        else if (($user->roles->pluck('role_name'))->containsStrict('Head of Academics Program'))
        {
            return redirect()->route('headofacadsprog-home');
        }
        else
        {
            return redirect()->route('director-home');
        }
        
    }
    return view('auth.login');
})->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index']);
Route::get('/pre-register', function () {
    return view('auth.pre-registration');
})->name('pre-register');

Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/pending', [RegisterController::class, 'pending'])->name('pending');

// Change Password Function
Route::post('/change-password', [ChangePasswordController::class, 'store'])->name('change-password');

// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'forgotpassword'])->name('forgot-password');
Route::post('/forgot-password-link', [ForgotPasswordController::class, 'resetpassword'])->name('forgot-password-link');
Route::get('/forgot-password/{token}', [ForgotPasswordController::class, 'forgotPasswordValidate']);
Route::post('/update-password', [ForgotPasswordController::class, 'updatepassword'])->name('update-password');


//============================================================================================================================================================================================

// ROUTES FOR SUPERADMIN
Route::get('/superadmin/home', [SuperadminController::class, 'index'])->name('superadmin-home');
Route::get('/superadmin/usermanagement/users', [UserController::class, 'index'])->name('superadmin-users');
Route::post('/superadmin/users', [UserController::class, 'store'])->name('superadmin-store');
Route::get('/superadmin/users/create', [UserController::class, 'create'])->name('superadmin-create');   
Route::get('/superadmin/usermanagement/edit-user/{user}', [UserController::class, 'edit'])->name('superadmin-users-edit');
Route::put('/superadmin/usermanagement/users/{user}', [UserController::class, 'update'])->name('superadmin-users-update');
Route::get('/superadmin/usermanagement/users/{user}', [UserController::class, 'show'])->name('superadmin-users-show');

// Rest Password
Route::get('/superadmin/reset-password/{user}', [UserController::class, 'reset'])->name('superadmin-reset');

// Course Maintenance
Route::get('/superadmin/courses/home', [SuperadminController::class , 'courses']) -> name('superadmin-courses');
Route::post('/superadmin/courses/store', [SuperadminController::class , 'storeCourse']) -> name('superadmin-courses-store');
Route::put('/superadmin/courses/update/{id}', [SuperadminController::class , 'updateCourse']) -> name('superadmin-courses-update');
Route::put('/superadmin/courses/delete/{id}', [SuperadminController::class , 'deleteCourse']) -> name('superadmin-courses-delete');

// Category Maintenance
Route::get('/superadmin/categories/home', [SuperadminController::class , 'categories']) -> name('superadmin-categories');
Route::post('/superadmin/categories/store', [SuperadminController::class , 'storeCategory']) -> name('superadmin-categories-store');
Route::put('/superadmin/categories/update/{id}', [SuperadminController::class , 'updateCategory']) -> name('superadmin-categories-update');
Route::put('/superadmin/categories/delete/{id}', [SuperadminController::class , 'deleteCategory']) -> name('superadmin-categories-delete');

//============================================================================================================================================================================================

// ROUTES FOR ADVISER
Route::get('/adviser/home', [AdviserController::class, 'index'])->name('adviser-home');
Route::get('/adviser/account', [AdviserController::class, 'account'])->name('adviser-account');
Route::put('/adviser/update', [AdviserController::class, 'update'])->name('adviser-update');
Route::get('/adviser/rooms', [AdviserController::class, 'rooms'])->name('adviser-room');
Route::get('/adviser/view/{id}/{file}', [AdviserController::class, 'viewFile'])->name('adviser-view');

//Checkbox
Route::post('/adviser/record', [AdviserController::class, 'updateRecord'])->name('update-record');

// Students
Route::get('/adviser/student-files/view-student-file', [AdviserController::class, 'viewStudentFile'])->name('adviser-students-file');
Route::get('/adviser/student-approval', [AdviserController::class, 'pendingStudents'])->name('adviser-student-pending');
Route::get('/adviser/students', [AdviserController::class, 'students'])->name('adviser-student');
Route::post('/adviser/students/create', [AdviserController::class, 'create'])->name('adviser-create');
Route::post('/adviser/students/creates', [AdviserController::class, 'creates'])->name('adviser-creates');
Route::post('/adviser/students/deny', [AdviserController::class, 'deny'])->name('adviser-deny');
Route::get('/adviser/students/{user}', [AdviserController::class, 'studentacc'])->name('adviser-view-student');
Route::get('/adviser/students/file/{user}', [AdviserController::class, 'studentfile'])->name('adviser-view-student-file');

// Change Password View
Route::get('/adviser/change-password', [ChangePasswordController::class, 'adviser'])->name('adviser-change');

// Pending
Route::get('/adviser/home/pending/moa', [AdviserController::class, 'moaApproval'])->name('adviser-moa');
Route::get('/adviser/home/pending/letter', [AdviserController::class, 'rlApproval'])->name('adviser-letter');
Route::get('/adviser/home/pending/sign', [AdviserController::class, 'signature'])->name('adviser-sign');

// Upload Approved Letter
Route::post('/adviser/home/pending/letter', [AdviserController::class, 'reupload'])->name('adviser-reupload');

// Approve Function
Route::put('/adviser/home/recommendation-letters/approve/{rl}', [AdviserController::class, 'clearRL'])->name('adviser-clearRL');
Route::put('/adviser/home/moa/approve/{moa}', [AdviserController::class, 'clearMoa'])->name('adviser-clearMoa');

// Deny Function
Route::put('/adviser/home/recommendation-letters/disapprove/{rl}', [AdviserController::class, 'rejectRL'])->name('adviser-rejectRL');
Route::put('/adviser/home/moa/disapprove/{moa}', [AdviserController::class, 'rejectMoa'])->name('adviser-rejectMoa');

// Approved Views
Route::get('/adviser/home/approved/letter', [AdviserController::class, 'approvedRL'])->name('adviser-letter-approved');
Route::get('/adviser/home/approved/moa', [AdviserController::class, 'approvedMoa'])->name('adviser-moa-approved');

// Disapproved Views
Route::get('/adviser/home/denied/letter', [AdviserController::class, 'disapprovedRL'])->name('adviser-letter-denied');
Route::get('/adviser/home/denied/moa', [AdviserController::class, 'disapprovedMoa'])->name('adviser-moa-denied');

// Download Function
Route::get('/adviser/home/moa/download/{user}/{file}', [AdviserController::class, 'downloadFile'])->name('adviser-downloadfiles');

// Room
Route::post('/adviser/rooms/add-room', [AdviserController::class, 'addRoom'])->name('adviser-addRoom');
Route::post('/adviser/rooms/delete-room/{room}', [AdviserController::class, 'deleteRoom'])->name('adviser-deleteRoom');
Route::put('/adviser/rooms/update-room/{room}', [AdviserController::class, 'updateRoom'])->name('adviser-updateRoom');
Route::get('/adviser/rooms/view-room/{room}', [AdviserController::class, 'viewRoom'])->name('adviser-viewRoom');
Route::get('/adviser/room/student-approval', [AdviserController::class, 'studentApproval'])->name('adviser-studentApproval');
Route::post('/adviser/room/student-approval/approve/{user}/{id}', [AdviserController::class, 'approveStudent'])->name('adviser-approve-student');
Route::post('/adviser/room/student-approval/disapprove/{user}/{id}', [AdviserController::class, 'disapproveStudent'])->name('adviser-disapprove-student');
Route::post('/adviser/rooms/view-room/remove-student/{id}/{room_id}', [AdviserController::class, 'removeStudent'])->name('adviser-remove-student');

// Announcements
Route::get('/adviser/announcements', [AdviserController::class, 'announcements'])->name('adviser-announcements');
Route::post('/adviser/room/announcements/new', [AdviserController::class, 'newAnnouncement'])->name('adviser-new-announcement');
Route::post('/adviser/room/announcements/delete/{id}', [AdviserController::class, 'deleteAnnouncement'])->name('adviser-delete-announcement');

// Company List
Route::get('/adviser/company', [AdviserController::class, 'moalist'])->name('adviser-company');
Route::post('/adviser/company', [AdviserController::class, 'addcompany'])->name('adviser-add-company');
Route::post('/adviser/company/update/{id}', [AdviserController::class, 'updatecompany'])->name('adviser-update-company');
Route::post('/adviser/company/remove/{id}', [AdviserController::class, 'removecompany'])->name('adviser-remove-company');

// Notify
Route::put('/adviser/home/approved/letter/{user}', [AdviserController::class, 'notify'])->name('adviser-notify');

//============================================================================================================================================================================================

// ROUTES FOR OJT COORDINATOR
Route::get('/ojt-coordinator/home', [OJTCoordinatorController::class, 'index'])->name('ojt-coordinator-home');
Route::get('/ojt-coordinator/student-files/view-student-file', [StudentFileController::class, 'viewStudentFile'])->name('students-file');
Route::get('/ojt-coordinator/account', [OJTCoordinatorController::class, 'account'])->name('ojt-coordinator-account');
Route::put('/ojt-coordinator/update', [OJTCoordinatorController::class, 'update'])->name('ojt-coordinator-update');
Route::get('/ojt-coordinator/downloadable', [OJTCoordinatorController::class, 'downloadable'])->name('ojt-coordinator-downloadable');
Route::post('/ojt-coordinator/upload', [OJTCoordinatorController::class, 'upload'])->name('ojt-coordinator-upload');

// Change password view
Route::get('/ojt-coordinator/change-password', [ChangePasswordController::class, 'coordinator'])->name('ojt-coordinator-change');

// Students
Route::get('/ojt-coordinator/students', [OJTCoordinatorController::class, 'students'])->name('ojt-coordinator-student');
Route::get('/ojt-coordinator/students/{user}', [OJTCoordinatorController::class, 'studentacc'])->name('ojt-coordinator-view-student');
Route::get('/ojt-coordinator/students/file/{user}', [OJTCoordinatorController::class, 'studentfile'])->name('ojt-coordinator-view-student-file');

// Upload Approved MOA
Route::post('/ojt-coordinator/student-files/pending-moa/', [StudentFileController::class, 'reupload'])->name('ojt-coordinator-reupload');

// Advisers
Route::get('/ojt-coordinator/advisers', [OJTCoordinatorController::class, 'advisers'])->name('ojt-coordinator-adviser');
Route::get('/ojt-coordinator/advisers/{user}', [OJTCoordinatorController::class, 'adviseracc'])->name('ojt-coordinator-view-adviser');
Route::post('/ojt-coordinator/users', [OJTCoordinatorController::class, 'store'])->name('ojt-coordinator-store');

// Function Memorandum of Agreement
Route::get('/ojt-coordinator/student-files/pending-moa', [StudentFileController::class, 'pendingMOA'])->name('pending-moa');
Route::get('/ojt-coordinator/student-files/readied-moa', [StudentFileController::class, 'readiedMOA'])->name('readied-moa');
Route::get('/ojt-coordinator/student-files/approved-moa', [StudentFileController::class, 'approvedMOA'])->name('approved-moa');
Route::get('/ojt-coordinator/student-files/disapproved-moa', [StudentFileController::class, 'disapprovedMOA'])->name('disapproved-moa');
Route::put('/ojt-coordinator/student-files/pending-moa/ready/{user}', [StudentFileController::class, 'readyMoa'])->name('ojt-coordinator-ready');
Route::put('/ojt-coordinator/student-files/pending-moa/disapprove/{user}', [StudentFileController::class, 'disapproveMoa'])->name('ojt-coordinator-disapprove');

// Company List
Route::get('/ojt-coordinator/company', [OJtCoordinatorController::class, 'moalist'])->name('ojt-coordinator-company');

// Download Function
Route::get('/ojt-coordinator/student-files/download/{user}/{file}', [StudentFileController::class, 'downloadFile'])->name('download-files');

// Notify
Route::put('/ojt-coordinator/student-files/approved-moa/{user}', [StudentFileController::class, 'notify'])->name('ojt-coordinator-notify');

//============================================================================================================================================================================================

// ROUTES FOR STUDENT
Route::get('/student/home', [StudentController::class, 'index'])->name('student-home');
Route::get('/student/account', [StudentController::class, 'account'])->name('student-account');
Route::put('/student/update', [StudentController::class, 'update'])->name('student-update');
Route::get('/student/ojt-info', [StudentController::class, 'ojtInfo'])->name('student-ojt');
Route::put('/student/ojt-info-update', [StudentController::class, 'infoUpdate'])->name('student-ojt-update');

// Files
Route::get('/student/uploading/upload', [UploadController::class, 'index'])->name('student-upload');
Route::get('/student/uploading/view-file', [UploadController::class, 'fileStudent'])->name('student-file');
Route::post('/student/uploading/upload', [UploadController::class, 'importStudents'])->name('student-upload-file');
Route::post('/student/uploading/remove/{id}', [UploadController::class, 'removeFile'])->name('student-remove-file');
Route::get('/student/upload/view/{id}', [UploadController::class, 'view'])->name('student-view-file');

// Upload Approved MOA
Route::post('/student/uploading/reupload/', [UploadController::class, 'reupload'])->name('student-reupload');

// Change Password View
Route::get('/student/change-password', [ChangePasswordController::class, 'student'])->name('student-change');

// Rooms
Route::get('/student/rooms/index', [StudentController::class, 'myRooms'])->name('student-rooms');
Route::post('/student/rooms/join-room/{room}', [StudentController::class, 'joinRoom'])->name('student-join-room');

// Company List
Route::get('/student/company', [StudentController::class, 'moalist'])->name('student-company');

//============================================================================================================================================================================================

// ROUTES FOR HEAD OF ACADEMICS PROGRAM
Route::get('/headofacademicsprogram/home', [HeadOfAcademicsProgramController::class, 'index'])->name('headofacadsprog-home');
Route::get('/headofacademicsprogram/account', [HeadOfAcademicsProgramController::class, 'account'])->name('headofacadsprog-account');

// Change password view
Route::get('/headofacademicsprogram/change-password', [ChangePasswordController::class, 'academics'])->name('headofacadsprog-change');

// Letter
Route::get('/headofacademicsprogram/pending-letters', [HeadOfAcademicsProgramController::class, 'pendingLetter'])->name('headofacadsprog-pending');
Route::get('/headofacademicsprogram/approved-letters', [HeadOfAcademicsProgramController::class, 'approvedLetter'])->name('headofacadsprog-approved');
Route::get('/headofacademicsprogram/disapproved-letters', [HeadOfAcademicsProgramController::class, 'disapprovedLetter'])->name('headofacadsprog-disapproved');
Route::get('/headofacademicsprogram/pending-letters/approve/{id}', [HeadOfAcademicsProgramController::class, 'clearRL'])->name('headofacadsprog-approve');
Route::get('/headofacademicsprogram/pending-letters/disapprove/{id}', [HeadOfAcademicsProgramController::class, 'rejectRL'])->name('headofacadsprog-disapprove');

// Donwload function
Route::get('/headofacademicsprogram/pending-letters/download/{user}/{file}', [HeadOfAcademicsProgramController::class, 'downloadFile'])->name('headofacadsprog-download');

//============================================================================================================================================================================================

// ROUTES FOR DIRECTOR
Route::get('/director/home', [DirectorController::class, 'index'])->name('director-home');
Route::get('/director/account', [DirectorController::class, 'account'])->name('director-account');

// Change password view
Route::get('/director/change-password', [ChangePasswordController::class, 'director'])->name('director-change');

// Letter
Route::get('/director/pending-letters', [DirectorController::class, 'pendingLetter'])->name('director-pending');
Route::get('/director/approved-letters', [DirectorController::class, 'approvedLetter'])->name('director-approved');
Route::get('/director/disapproved-letters', [DirectorController::class, 'disapprovedLetter'])->name('director-disapproved');
Route::get('/director/pending-letters/approve/{id}', [DirectorController::class, 'clearRL'])->name('director-approve');
Route::get('/director/pending-letters/disapprove/{id}', [DirectorController::class, 'rejectRL'])->name('director-disapprove');

// Downlod function
Route::get('/director/pending-letters/download/{user}/{file}', [DirectorController::class, 'downloadFile'])->name('director-download');



