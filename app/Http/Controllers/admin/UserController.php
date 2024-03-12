<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('created_at','DESC')->paginate(10);
        return view('admin.users.list',[
            'users' => $users,
        ]);
    }

    // Edit users
    public function edit($id){

        $user = User::findOrFail($id);
        return view('admin.users.edit',[
            'user' => $user,
        ]);
    }
    // Update here
    public function update(Request $request, $id){

        $data = [
            'name' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users,email,'.$id.',id',
        ];

        $validator = Validator::make($request->all(),$data);

        if($validator->passes()){

            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->designation = $request->designation;
            $user->mobile = $request->mobile;
            $user->save();

            Session()->flash('success','User information updated successfully.');
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

    // delete user
    public function destroy(Request $request){

        $user = User::find($request->id);

        if($user == null){
            Session()->flash('error','User not found');
            return response()->json([
                'status' => false,
            ]);
        }

        $user->delete();
        Session()->flash('success','User deleted successfully');
        return response()->json([
            'status' => true,
        ]);
    }



}
