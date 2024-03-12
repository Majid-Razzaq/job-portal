<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\JobType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class JobTypeController extends Controller
{
    public function index(){
        $job_types = JobType::orderBy('name','DESC')->paginate(8);
        return view('admin.JobTypes.list',[
            'job_types' => $job_types,
        ]);
    }


    public function destroy($id){

        $job_types = JobType::find($id);

        if($job_types == null){
            $message = "Job Type not found";
            Session()->flash('error',$message);
            return response()->json([
                'status' => false,
                'message' => $message,
            ]);
        }

        $job_types->delete();
        $message = "Job Type deleted successfully.";
        Session()->flash('success',$message);
        return response()->json([
            'status' => true,
            'message' => $message,
        ]);

    }

    public function create(){
        return view('admin.JobTypes.create');
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if($validator->passes()){

            $job_types = new JobType;
            $job_types->name = $request->name;
            $job_types->status = $request->status;
            $job_types->save();

            $message = 'Job Type added successfully.';
            Session()->flash('success',$message);
            return response()->json([
                'status' => true,
                'message' => $message,
            ]);

        }else{
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }

    public function edit($id){

        $job_type = JobType::findOrFail($id);
        return view('admin.JobTypes.edit',[
            'job_type' => $job_type,
        ]);

    }

    public function update(Request $request, $id){

        $job_type = JobType::find($id);

        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }else{

            $job_type->name = $request->name;
            $job_type->status = $request->status;
            $job_type->save();

            $message = "Job Type updated successfully.";
            Session()->flash('success',$message);
            return response()->json([
                'status' => true,
                'message' => $message,
            ]);
        }

    }
}
