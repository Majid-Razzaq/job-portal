<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Job;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use PhpParser\Node\Expr\FuncCall;

class JobController extends Controller
{
    public function index(){

        $jobs = Job::orderBy('created_at','DESC')->with('user','applications')->paginate(10);
        return view('admin.jobs.list',[
            'jobs' => $jobs,
        ]);
    }


    public Function edit($id){

        $job = Job::findOrFail($id);
        $categories = Category::orderBy('name','ASC')->where('status',1)->get();
        $job_types = JobType::orderBy('name','ASC')->where('status',1)->get();
        return view("admin.jobs.edit",[
            'job' => $job,
            'categories' => $categories,
            'job_types' => $job_types,
        ]);
    }


    public function update(Request $request, $jobId){

        $data = [
            'title' => 'required|min:5|max:200',
            'category' => 'required',
            'jobType' => 'required',
            'vacancy' => 'required|integer',
            'location' => 'required|max:50',
            'description' => 'required',
            'experience' => 'required',
            'company_name' => 'required|min:3|max:75',
        ];

        $validator = Validator::make($request->all(),$data);
        if($validator->passes()){

            $job = Job::find($jobId);
            $job->title = $request->title;
            $job->category_id = $request->category;
            $job->job_type_id = $request->jobType;
            $job->vacancy = $request->vacancy;
            $job->salary = $request->salary;
            $job->location = $request->location;
            $job->description = $request->description;
            $job->benefits = $request->benefits;
            $job->responsibility = $request->responsibility;
            $job->qualifications = $request->qualifications;
            $job->keywords = $request->keywords;
            $job->experience = $request->experience;
            $job->company_name = $request->company_name;
            $job->company_location = $request->company_location;
            $job->company_website = $request->company_website;
            $job->status = $request->status;
            $job->isFeatured = (!empty($request->isFeatured)) ? $request->isFeatured : 0;
            $job->save();

            Session()->flash('success','Job updated successfully.');
            return response()->json([
                'status' => true,
                'errors' => [],
            ]);
        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }

    }

    public function destroy(Request $request){

        $job = Job::find($request->id);

        if($job == null){
            $message = "Job not found";
            Session()->flash('error',$message);
            return response()->json([
                'status' => false,
                'message' => $message,
            ]);
        }
        $job->delete();

        $message = "Job deleted succefully";
        Session()->flash('success',$message);
        return response()->json([
            'status' => true,
            'message' => $message,
        ]);

    }
}
