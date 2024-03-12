<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{


    public function index(){

        // $jobs = Job::where([
        //     'status' => 1,
        // ])->with(['jobType','category'])->get();

        $jobApplications = JobApplication::orderBy('applied_date','DESC')
                                ->with('job','user','employer')
                                ->paginate(8);
        return view('admin.job-applications.list',[
            'jobApplications' => $jobApplications,
        ]);
    }


    // Remove Job Application
    public function destroy(Request $request){

        $job_application = JobApplication::find($request->job_id);

        if($job_application == null){
            Session()->flash('error','Either job application deleted or not found');
            return response()->json([
                'status' => true,
            ]);
        }

        JobApplication::where([
            'id' => $request->job_id,
        ])->delete();

        Session()->flash('success','Job Application deleted succeffully');
        return response()->json([
            'status' => true,
        ]);

    }
}
