<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::orderBy('name','DESC')->paginate(8);
        return view('admin.categories.list',[
            'categories' => $categories,
        ]);
    }

    public function edit($id){

        $category = Category::findorFail($id);
        return view('admin.categories.edit',[
            'category' => $category,
        ]);
    }

    public function update(Request $request,$id){

        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);
        if($validator->passes()){
            $category = Category::find($id);
            $category->name = $request->name;
            $category->status = $request->status;
            $category->save();

            $message = "Category updated successfully";
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

    public function destroy(Request $request){

        $category = Category::find($request->id);
        if($category == null){
            $message = "Job not found.";
            Session()->flash('error',$message);
            return response()->json([
                'status' => false,
                'message' => $message,
            ]);
        }

        $category->delete();
        $message = "Job deleted successfully.";
        Session()->flash('success',$message);
        return response()->json([
            'status' => true,
            'message' => $message,
        ]);
    }

    public function create(){
        return view('admin.categories.create');
    }

    public function save(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
        ]);

        if($validator->passes()){
            $category = new Category;
            $category->name = $request->name;
            $category->status = $request->status;
            $category->save();

            $message = "Category created successfully";
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
}
