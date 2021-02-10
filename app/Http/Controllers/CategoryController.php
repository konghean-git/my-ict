<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id','desc')->get();
        return view('admin.categories.category',['categories'=>$categories]);
    }
    public function create()
    {
        return view('admin.categories.create');
    }
    public function create_submit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'  => 'required',
            'group_code' =>'required'
            ]);
        if($validator->fails()){
            $errors = $validator->errors()->toArray();
            $message = "";
            foreach($errors as $error){
                $message = $error[0];
            }
            return '<script>alert("' .$message. '")</script>';
        }

        $name           = $request->input('name');
        $group_code     = $request->input('group_code');
        $description    = $request->input('description');

        $category = new Category();
        $category->name         = $name;
        $category->group_code   = $group_code;
        $category->description  = $description;
        $category->save();
        return redirect('categories');
    }
    public function update($id)
    {  
        $category = Category::find($id);
        return view('admin.categories.update',['category'=>$category]);
    }
    public function update_submit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'  => 'required',
            'group_code' =>'required'
            ]);
        if($validator->fails()){
            $errors = $validator->errors()->toArray();
            $message = "";
            foreach($errors as $error){
                $message = $error[0];
            }
            return '<script>alert("' .$message. '")</script>';
        }


        $category = Category::find($request->input('category_id'));
        $category->name = $request->input('name');
        $category->group_code = $request->input('group_code');
        $category->description = $request->input('description');
        $category->save();
        return redirect('/categories');
    }

    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
        return json_encode([
            'status' => 1,
            'message' => 'Delete succcessfully',
        ]);
    }
}