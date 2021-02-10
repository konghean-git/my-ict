<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Branch;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::orderBy('id','desc')->get();
        return view('admin.branches.branch',['branches'=>$branches]);
    }

    public function create()
    {
        return view('admin.branches.create');
    }

    public function create_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|unique:branches',
            'description'   => 'max:255',
            'map_link'      => 'max:255',
            'city'          => 'required'
        ]);

        if($validator->fails()){
            $errors = $validator->errors()->toArray();
            $message = "";
            foreach($errors as $error){
                $message = $error[0];
            }
            return '<script>alert("' .$message. '")</script>';
        }
        
        $branch = Branch::create([
            'name'          => $request->input('name'),
            'city'          => $request->input('city'),
            'county'          => $request->input('country'),
            'map_link'      => $request->input('map_link'),
            'description'   => $request->input('description'),
        ]);
        return redirect('branches');
    }

    public function update($id) 
    {
        $branch = Branch::find($id);
        return view('admin.branches.update',compact('branch'));
    }

    public function update_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required',
            'description'   => 'max:255',
            'map_link'      => 'max:255',
            'city'          => 'required'
        ]);

        if($validator->fails()){
            $errors = $validator->errors()->toArray();
            $message = "";
            foreach($errors as $error){
                $message = $error[0];
            }
            return '<script>alert("' .$message. '")</script>';
        }
        $branch_id = $request->input('branch_id');
        $branch =  Branch::find($branch_id);

        $branch->name           = $request->input('name');
        $branch->city           = $request->input('city');
        $branch->country        = $request->input('country');
        $branch->map_link       = $request->input('map_link');
        $branch->description    = $request->input('description');

        $branch->save();
        return redirect('branches');
    }

    public function delete($id)
    {
        $branch = Branch::find($id);
        $branch->delete();
        return json_encode([
            'status' => 1,
            'message' => 'Delete succcessfully',
        ]);
    }
}
