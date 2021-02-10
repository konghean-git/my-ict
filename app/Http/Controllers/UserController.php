<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use function Symfony\Component\VarDumper\Dumper\esc;

class UserController extends Controller
{
    public function index()
    {
        $branches = Branch::get();
        $divisions = User::select('division')->groupBy('division')->pluck('division');
        $departments = User::select('department')->groupBy('department')->pluck('department');
        $positions= User::select('position')->groupBy('position')->pluck('position');
        $users = User::orderBy('code','asc')->get();
        return view('admin.users.users',['users'=>$users,'branches'=>$branches,'divisions'=>$divisions,'departments' => $departments,'positions'=>$positions]);
    }


    public function create()
    {
        $last_code = User::max('code')+1;
        $branches = Branch::get();
        return view('admin.users.create',['branches'=>$branches,'last_code'=>$last_code]);
    }


    public function create_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code'          => 'required|unique:users',
            'email'         => 'required|unique:users',
            'name'          => 'required',
            'branch_id'     => 'required',
            'gender'        => 'required',
            'department'    => 'required',
            'position'      => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            $messages="";
            foreach($errors as $error){
                $messages .= $error[0];
            }
            return '<script>alert("' . $messages . '")</script>';
        }

        $image = $request->file('image');

        if(!empty($image)){
            // return time() . '.' . $image->getClientOriginalExtension();
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'),$image_name);
        }else{
            $image_name = "none.jpg";
        }

        $user = User::create([
            'code'          =>$request->input('code'),
            'name'          =>$request->input('name'),
            'branch_id'     =>$request->input('branch_id'),
            'gender'        =>$request->input('gender'),
            'division'      =>$request->input('division'),
            'department'    =>$request->input('department'),
            'position'      =>$request->input('position'),
            'phone'         =>$request->input('phone'),
            'status'        =>$request->input('status'),
            'email'         =>$request->input('email'),
            'password'      =>bcrypt('123abc!biz'),
            'image'         =>$image_name,
        ]);
        return redirect('users')->with('success','User created successfull');
    }


    public function update($id)
    {
        $branches = Branch::get();
        $user = User::find($id);
        return view('admin.users.update',['user'=>$user,'branches'=>$branches]);
    }

    public function update_submit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'            => 'required',
            'code'          => 'required',
            'name'          => 'required',
            'branch_id'     => 'required',
            'gender'        => 'required',
            'department'    => 'required',
            'position'      => 'required',
            

        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            $messages="";
            foreach($errors as $error){
                $messages .= $error[0];
            }
            return '<script>alert("' . $messages . '")</script>';
        }


        
        $image = $request->file('image');
       
        $user = User::find($request->input('id'));
        // if($employee->code == $request->input('code')){
        //     return $employee->code;
        // }
        //     return $employee->name;
        if(!empty($image)){
            // return time() . '.' . $image->getClientOriginalExtension();
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'),$image_name);
            $user->image        = $image_name;
        }


        $user->code         = $request->input('code');
        $user->name         = $request->input('name');
        $user->gender       = $request->input('gender');
        $user->branch_id    = $request->input('branch_id');
        $user->division     = $request->input('division');
        $user->department   = $request->input('department');
        $user->position     = $request->input('position');
        $user->email        = $request->input('email');
        $user->phone        = $request->input('phone');
        $user->status       = $request->input('status');
        
        $user->save();
        return redirect('users')->with('edit_success','user updated successful');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $user->delete();
        return json_encode([
            'status' => 1,
            'message' => 'Delete succcessfully',
        ]);
    }
    public function detail($id)
    {
        $branches = Branch::get();
        $user = User::find($id);
        return view('admin.users.detail',['user'=>$user,'branches'=>$branches]);
    }
    public function live_search(Request $request)
    {       
        if($request->ajax()){
            if($request->get('searchQuery') != ''){
                $query = $request->get('searchQuery');
                $data = DB::table('users')
                        ->where('name','like','%' . $query . '%')
                        ->orWhere('division','like','%' . $query . '%')
                        ->orWhere('department','like','%' . $query . '%')
                        ->orWhere('position','like','%' . $query . '%')
                        ->orWhere('email','like','%' . $query . '%')
                        ->orWhere('code','like','%' . $query . '%')
                        ->get();
                return json_encode($data);
            }else{
                $data = DB::table('users')->take(10)->orderBy('code','asc')->get();
                return json_encode($data);
            }
        }
    }
    public function branch_filter(Request $request)
    {       
        if($request->ajax()){
            if($request->get('selectedValues') != ''){
                $branch = $request->get('selectedValues');
                // $branches = $request->get('branches');
                $data = DB::table('users')->select('*')
                            ->where('branch_id',$branch[0])
                            ->orderBy('code','asc');
                
                // Array Gender = 1
                if(count($branch) == 1){
                    if($branch[0] == 'all'){
                        $data = DB::table('users')->select('*')->orderBy('code','asc');
                    }else{
                        $data;
                    }
                // Array Gender > 1
                }elseif(count($branch) > 1){
                    for($num = 0; $num<count($branch); $num++){
                        $data->orWhere('branch_id',$branch[$num])->orderBy('code','asc');
                    }
                }
                return json_encode($data->get());
            }else{
                $data = DB::table('users')->take(10)->orderBy('code','asc')->get();
                return json_encode($data);
            }
        }
    }

    public function division_filter(Request $request)
    {       
        if($request->ajax()){
            if($request->get('selectedValues') != ''){
                $division = $request->get('selectedValues');
                // $branches = $request->get('branches');
                $data = DB::table('users')->select('*')
                            ->where('division',$division[0])
                            ->orderBy('code','asc');
                
                // Array Gender = 1
                if(count($division) == 1){
                    if($division[0] == 'all'){
                        $data = DB::table('users')->select('*')->orderBy('code','asc');
                    }else{
                        $data;
                    }
                // Array Gender > 1
                }elseif(count($division) > 1){
                    for($num = 0; $num<count($division); $num++){
                        $data->orWhere('division',$division[$num])->orderBy('code','asc');
                    }
                }
                return json_encode($data->get());
            }else{
                $data = DB::table('users')->take(10)->orderBy('code','asc')->get();
                return json_encode($data);
            }
        }
    }

    public function department_filter(Request $request)
    {       
        if($request->ajax()){
            if($request->get('selectedValues') != ''){
                $department = $request->get('selectedValues');
                // $branches = $request->get('branches');
                $data = DB::table('users')->select('*')
                            ->where('department',$department[0])
                            ->orderBy('code','asc');
                
                // Array Gender = 1
                if(count($department) == 1){
                    if($department[0] == 'all'){
                        $data = DB::table('users')->select('*')->orderBy('code','asc');
                    }else{
                        $data;
                    }
                // Array Gender > 1
                }elseif(count($department) > 1){
                    for($num = 0; $num<count($department); $num++){
                        $data->orWhere('department',$department[$num])->orderBy('code','asc');
                    }
                }
                return json_encode($data->get());
            }else{
                $data = DB::table('users')->take(10)->orderBy('code','asc')->get();
                return json_encode($data);
            }
        }
    }
    public function position_filter(Request $request)
    {       
        if($request->ajax()){
            if($request->get('selectedValues') != ''){
                $position = $request->get('selectedValues');
                // $branches = $request->get('branches');
                $data = DB::table('users')->select('*')
                            ->where('position',$position[0])
                            ->orderBy('code','asc');
                
                // Array Gender = 1
                if(count($position) == 1){
                    if($position[0] == 'all'){
                        $data = DB::table('users')->select('*')->orderBy('code','asc');
                    }else{
                        $data;
                    }
                // Array Gender > 1
                }elseif(count($position) > 1){
                    for($num = 0; $num<count($position); $num++){
                        $data->orWhere('position',$position[$num])->orderBy('code','asc');
                    }
                }
                return json_encode($data->get());
            }else{
                $data = DB::table('users')->take(10)->orderBy('code','asc')->get();
                return json_encode($data);
            }
        }
    }
    // public function filter()
    // {
    //     $division = User::select('division')->groupBy('division')->pluck('division');
    //     $department = User::select('department')->distinct()->get();
    //     $position= User::select('position')->distinct()->get();
    //     // $value = $division->toArray();
    //     // dd($division);
    //     echo $division;
    // }
}