<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;
use App\Models\InventoryUser;
use Illuminate\Support\Facades\Validator;

class UsageController extends Controller
{
    public function create_usage($id)
    {
        $users = User::orderBy('name','asc')->get();
        $inventory = Inventory::find($id);
        $inventories = Inventory::get();
        $max_dn="";
        foreach($inventories as $inv){
            foreach($inv->users as $user){
                $max_dn = $user->pivot->max('delivery_node_code')+1;
            }
        }
        if(empty($max_dn)==true){
            $max_dn = 1;
        }
        return view('admin.usages.create',['users'=>$users,'inventory'=>$inventory,'max_dn'=>$max_dn]);
    }

    // Give User Informantion When Choose User
    public function get_user_info($id)
    {
        echo json_encode(DB::table('users')->where('id',$id)->get());
        //    return $user = User::where('id',$id)->get();
    }

    public function transfer_now(Request $request)      
    {
        $validator = Validator::make($request->all(),[
            'user_id'           => 'required',
            'inventory_id'      => 'required',
            'delivery_node_code'=> 'required | unique:inventory_user',
            'start_date'        => 'required',
            'user_type'         => 'required',
            'preparer_id'       => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            $messages="";
            foreach($errors as $error){
                $messages .= $error[0];
            }
            return '<script>alert("' . $messages . '")</script>';
        }
        // $inventory = Inventory::find($request->input('inventory_id'));
        $inventory_id           = $request->input('inventory_id');
        $user_id                = $request->input('user_id');
        $dn_code                = $request->input('delivery_node_code');
        $reference_id           = $request->input('reference_id');
        $condition              = $request->input('condition');
        $accessary              = $request->input('accessary');
        $inventory_description  = $request->input('inventory_description');
        $usage_description      = $request->input('usage_description');
        $started_at             = $request->input('start_date');
        $user_type              = $request->input('user_type');
        $preparer_id            = $request->input('preparer_id');
        if($user_type == 0){
            $finished_at    = $request->input('expire_date');
        }else{
            $finished_at = null;
        }
        $inventory = Inventory::find($inventory_id);
        $inventory->status = 3;
        $inventory->users()->attach([$user_id=>[
            'delivery_node_code'    => $dn_code,
            'reference_id'          => $reference_id,
            'preparer_id'           => $preparer_id,
            'condition'             => $condition,
            'accessary'             => $accessary,
            'is_normal_user'        => $user_type,
            'is_printed'            => 0,
            'inventory_description' => $inventory_description,
            'usage_description'     => $usage_description,
            'started_at'            => $started_at,
            'finished_at'           => $finished_at
        ]]);
        $inventory->save();
        return redirect('/inventories');
    }

    public function transfer_print(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'user_id'           => 'required',
            'inventory_id'      => 'required',
            'delivery_node_code'=> 'required | unique:inventory_user',
            'start_date'        => 'required',
            'user_type'         => 'required',
            'preparer_id'       => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            $messages="";
            foreach($errors as $error){
                $messages .= $error[0];
            }
            return '<script>alert("' . $messages . '")</script>';
        }
        $inventory = Inventory::find($request->input('inventory_id'));
        $inventory_id   = $request->input('inventory_id');
        $user_id        = $request->input('user_id');
        $dn_code        = $request->input('delivery_node_code');
        $reference_id   = $request->input('reference_id');
        $condition      = $request->input('condition');
        $accessary      = $request->input('accessary');
        $inventory_description  = $request->input('inventory_description');
        $usage_description      = $request->input('usage_description');
        $started_at     = $request->input('start_date');
        $user_type      = $request->input('user_type');
        $preparer_id    = $request->input('preparer_id');
        if($user_type == 0){
            $finished_at    = $request->input('expire_date');
        }else{
            $finished_at = null;
        }
        $inventory = Inventory::find($inventory_id);
        $inventory->status = 3;
        $inventory->users()->attach([$user_id=>[
            'delivery_node_code'    => $dn_code,
            'reference_id'          => $reference_id,
            'preparer_id'           => $preparer_id,
            'condition'             => $condition,
            'accessary'             => $accessary,
            'is_normal_user'        => $user_type,
            'is_printed'            => 1,
            'inventory_description' => $inventory_description,
            'usage_description'     => $usage_description,
            'started_at'            => $started_at,
            'finished_at'           => $finished_at
        ]]);
        $inventory->save();
        // $user = User::find($user_id);
        // $inventory = Inventory::find($inventory_id);
        // $inv_usr = InventoryUser::where('inventory_id',$inventory_id)->where('user_id',$user_id)->max('id');
        // $delivery_note = InventoryUser::find($inv_usr);
        // // return $delivery_note->name;
        // return view('admin.usages.print_out',['delivery_note'=>$delivery_note,'user'=>$user,'inventory'=>$inventory]);


        $inv_usr = InventoryUser::where('inventory_id',$inventory_id)->where('user_id',$user_id)->max('id');
        $delivery_note = InventoryUser::find($inv_usr);
        return view('admin.usages.print_out',['delivery_note'=>$delivery_note]);

        // $inv_usr = InventoryUser::where('inventory_id',6)->where('user_id',48)->max('id');
        // $delivery_note = InventoryUser::find($inv_usr);
        // return view('admin.usages.print_out',['delivery_note'=>$delivery_note]);
    }

    public function update_usage($id)
    {
        $usage = InventoryUser::find($id);
        return $usage->users->name;
    }

    public function detail_usage($id)
    {
        $usage = InventoryUser::find($id);
        return view('admin.usages.detail',['usage'=>$usage]);
    }
    public function return_usage($id){
        $query = "IT S";
        $query1 = "IT Ma";
        $users = User::where('position','like','%' . $query . '%')->orWhere('position','like','%' . $query1 . '%')->get();
        $usage = InventoryUser::find($id);
        
        return view('admin.usages.return',compact('usage','users'));
    }

    public function return_submit(Request $request)
    {
        $usage_id = $request->input('usage_id');
        $reason = $request->input('reason');
        $checker = $request->input('checker');
        $finished_at = $request->input('finished_at');
        $usage = InventoryUser::find($usage_id);
        $inventory = Inventory::find($usage->inventory_id);
        $user = User::find($usage->user_id);
        if($reason == "Resign"){
            $user->status = 0;
        }elseif($reason == 'Broken'){
            $inventory->condition = 4;
        }
        $usage->usage_description ="Return reason is(" .$reason. ") Checked By(" .$checker. ").";
        $usage->is_using = 0;
        $usage->finished_at = $finished_at;
        $inventory->status = 2;
        $user->save();
        $inventory->save();
        $usage->save();
        return redirect('inventories/detail/' . $inventory->id);
    }

    public function usages()
    {
        $usages = InventoryUser::orderBy('delivery_node_code','desc')->get();
        return view('admin.usages.usage',compact('usages'));
    }
    public function usages_report()
    {
        $pending = InventoryUser::where('is_printed',0)->orderBy('delivery_node_code','desc')->get();
        $printed = InventoryUser::where('is_printed',1)->orderBy('delivery_node_code','desc')->get();
        return view('admin.usages.delivery_note',compact('pending','printed'));
    }

    public function delete_usage($id)
    {
        
        $usage = InventoryUser::find($id);
        $usage->delete();
        return json_encode([
            'status' => 1,
            'message' => 'Delete succcessfully',
        ]);
    }
    // public function find_id()
    // {
    //     $inventory =  InventoryUser::get();
    //     foreach($inventory as $user){
    //         echo $user->id;
    //     }
    //     // return $inventory->inventories->model;
    // }

}