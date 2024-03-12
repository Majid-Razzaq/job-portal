<?php
use App\Http\Controllers\AccountController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\JobApplicationController;
use App\Http\Controllers\admin\JobController;
use App\Http\Controllers\admin\JobTypeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/',[HomeController::class,'index'])->name('home');
Route::get('/jobs',[JobsController::class,'index'])->name('jobs');
Route::get('/jobs/detail/{id}',[JobsController::class,'jobDetail'])->name('jobDetail');
// Apply job Route
Route::post('/apply-job',[JobsController::class,'applyJob'])->name('applyJob');
Route::post('/save-job',[JobsController::class,'saveJob'])->name('saveJob');
// Forgot password
Route::get('/forgot-password',[AccountController::class,'forgotPassword'])->name('account.forgotPassword');
Route::post('/process-forgot-password',[AccountController::class,'processForgotPassword'])->name('account.processForgotPassword');
Route::get('/reset-password/{token}',[AccountController::class,'resetPassword'])->name('account.resetPassword');
Route::post('/process-reset-password',[AccountController::class,'processResetPassword'])->name('account.processResetPassword');

Route::group(['prefix' => 'admin','middleware' => 'checkRole'], function () {
    // only admin can get this route
        Route::get('/dashboard',[DashboardController::class,'index'])->name('admin.dashboard');
        Route::get('/users',[UserController::class,'index'])->name('admin.users');
        Route::delete('/users',[UserController::class,'destroy'])->name('admin.user.destroy');
        Route::get('/user/{id}',[UserController::class,'edit'])->name('admin.user.edit');
        Route::put('/user/{id}',[UserController::class,'update'])->name('admin.user.update');
        // Routes for Job Applications
        Route::get('/job-applications',[JobApplicationController::class,'index'])->name('admin.jobApplications');
        Route::delete('/job-applications',[JobApplicationController::class,'destroy'])->name('admin.jobApplications.destroy');
        // Routes for Jobs
        Route::get('/jobs',[JobController::class,'index'])->name('admin.jobs');
        Route::delete('/jobs',[JobController::class,'destroy'])->name('admin.job.destroy');
        Route::get('/job/edit/{id}',[JobController::class,'edit'])->name('admin.job.edit');
        Route::put('/update-job/{jobId}',[JobController::class,'update'])->name('admin.job.update');
        // Routes for Categories
        Route::get('/create-category',[CategoryController::class,'create'])->name('admin.categories.create');
        Route::post('/create-category',[CategoryController::class,'save'])->name('admin.categories.save');
        Route::get('/categories',[CategoryController::class,'index'])->name('admin.categories');
        Route::get('/category/edit/{id}',[CategoryController::class,'edit'])->name('admin.categories.edit');
        Route::put('/category/{id}',[CategoryController::class,'update'])->name('admin.categories.update');
        Route::delete('/categories',[CategoryController::class,'destroy'])->name('admin.categories.destroy');
        // Job Types
        Route::get('/job-types',[JobTypeController::class,'index'])->name('admin.job_types');
        Route::delete('/job-types/{id}',[JobTypeController::class,'destroy'])->name('admin.job_types.destroy');
        Route::get('/create-job-types',[JobTypeController::class,'create'])->name('admin.job_types.create');
        Route::post('/save-job-types',[JobTypeController::class,'save'])->name('admin.job_types.save');
        Route::get('/edit-job-types/{id}',[JobTypeController::class,'edit'])->name('admin.job_types.edit');
        Route::put('/update-job-types/{id}',[JobTypeController::class,'update'])->name('admin.job_types.update');
    });

// Middleware
Route::group(['prefix' => 'account'], function () {

    // Guest Route
    Route::group(['middleware' => 'guest'], function(){
        Route::get('/register',[AccountController::class,'registration'])->name('account.registration');
        Route::post('/process-register',[AccountController::class,'processRegistration'])->name('account.processRegistration');
        Route::get('/login',[AccountController::class,'login'])->name('account.login');
        Route::post('/authenticate',[AccountController::class,'authenticate'])->name('account.authenticate');
    });

    // Authenticate Route
    Route::group(['middleware' => 'auth'], function(){
        Route::get('/profile',[AccountController::class,'profile'])->name('account.profile');
        Route::put('/update-profile',[AccountController::class,'updateProfile'])->name('account.updateProfile');
        Route::get('/logout',[AccountController::class,'logout'])->name('account.logout');
        Route::post('/update-profile-img',[AccountController::class,'updateProfileImg'])->name('account.updateProfileImg');
        Route::get('/create-job',[AccountController::class,'createJob'])->name('account.createJob');
        Route::post('/save-job',[AccountController::class,'saveJob'])->name('account.saveJob');
        Route::get('/my-jobs',[AccountController::class,'myJobs'])->name('account.myJobs');
        Route::get('/edit-job/edit/{jobId}',[AccountController::class,'editJob'])->name('account.editJob');
        Route::post('/update-job/{jobId}',[AccountController::class,'updateJob'])->name('account.updateJob');
        Route::post('/delete-job',[AccountController::class,'deleteJob'])->name('account.deleteJob');
        Route::get('/my-jobs-applications',[AccountController::class,'myJobApplications'])->name('account.myJobApplications');
        Route::post('/remove-job-application',[AccountController::class,'removeJobs'])->name('account.removeJobs');
        Route::get('/saved-jobs',[AccountController::class,'savedJobs'])->name('account.savedJobs');
        Route::post('/remove-saved-job',[AccountController::class,'removeSavedJob'])->name('account.removeSavedJob');
        // Change Password
        Route::post('/change-password',[AccountController::class,'changePassword'])->name('account.changePassword');
    });

});
