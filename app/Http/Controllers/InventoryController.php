<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\InventoryUser;
use App\Models\Category;
use App\Models\Branch;
use App\Models\Vendor;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class InventoryController extends Controller
{

    // View All
    public function index()
    {   
        $models = Inventory::select('model')->groupBy('model')->pluck('model');
        $status = Inventory::select('status')->groupBy('status')->pluck('status');
        $vendors = Vendor::get();
        $invoice_number = Inventory::select('invoice_number')->groupBy('invoice_number')->pluck('invoice_number');
        $targets = Inventory::select('target')->groupBy('target')->pluck('target');
        $categories = Category::get();
        $inventories = Inventory::get();
        return view('admin.products.inventories',['inventories'=>$inventories,'categories'=>$categories,'models'=>$models,'status'=>$status,'invoice_number'=>$invoice_number,'targets'=>$targets,'vendors'=>$vendors]);
    }

    // Available Computer
    public function available()
    {
        $computers = Inventory::where('status',1)->orWhere('status',2)->get();
        return view('backend.inventory.available',['computers'=>$computers]);
    }

    
    // Full Detail
    public function detail($id)
    {   $inventory = Inventory::find($id);
        $usages = InventoryUser::where('inventory_id',$id)->get();
        $max_status = InventoryUser::where('inventory_id',$id)->max('id');
        $status = InventoryUser::find($max_status);
        // dd($usages);
        return view('admin.products.detail',compact('inventory','usages','status'));
        // return $status->is_using;
    }


    // Category Change

    public function category_change(Request $request)
    {
        if($request->ajax){
            $category_id = $request->get('selectedValues');
            $date =  Category::find($category_id);
            return json_encode($data);
        }
    }

    // Create Inventory Form
    public function create()
    {   

        $max_pronith = Inventory::where('target','Pronith')->max('code');
        $max_hq = Inventory::where('target','!=','Pronith')->max('code');
        $branches = Branch::get();
        $categories = Category::get();
        return view('admin.products.create',['max_pronith'=>$max_pronith,'max_hq'=>$max_hq,'categories'=>$categories,'branches'=>$branches]);
    }

    // Store Inventory
    public function create_submit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'code'          => 'required | unique:inventories',
            'model'         => 'required',
            'condition'     => 'required',
            'category_id'   => 'required',
            'target'        => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            $messages="";
            foreach($errors as $error){
                $messages .= $error[0];
            }
            return '<script>alert("' . $messages . '")</script>';
        }

        $target         = $request->input('target');
        $code           = $request->input('code');
        $model          = $request->input('model');
        $category_id    = $request->input('category_id');
        $serial         = $request->input('serial');
        $condition      = $request->input('condition');
        $invoice_number = $request->input('invoice_number');
        $vendor      = $request->input('vendor');
        $color          = $request->input('color');
        $accessary      = $request->input('accessary');
        $description    = $request->input('description');
        $remark         = $request->input('remark');
        $invoice_date   = $request->input('invoice_date');
        $check_date     = $request->input('check_date');
        $price  = $request->input('price');

    
        // Image
        $status = 0;
        if($condition == "New"){
            $status = 1;
        }elseif($condition == "Medium" or $condition == "Low"){
            $status = 2;
        }else{
            $status = 4;
        }

        $image = $request->file('image');
        if(!empty($image)){
            // return time() . '.' . $image->getClientOriginalExtension();
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'),$image_name);
        }else{
            $image_name = "none_inv.jpg";
        }
        

        // Object Create Field
        $inventory = new Inventory();
        $inventory->code            = $code;
        $inventory->model           = $model;
        $inventory->category_id     = $category_id;
        $inventory->serial          = $serial;
        $inventory->condition       = $condition;
        $inventory->price           = $price;
        $inventory->invoice_number  = $invoice_number;
        $inventory->vendor_id          = $vendor;
        $inventory->color           = $color;
        $inventory->accessary       = $accessary;
        $inventory->description     = $description;
        $inventory->target          = $target;
        $inventory->status          = $status;
        $inventory->remark          = $remark;
        $inventory->image           = $image_name;
        // $inventory->save();
        if ($check_date == 'on'){
            $inventory->created_at = $invoice_date;
            $inventory->save();
        } else{
            $inventory->save();
        }
        return redirect('/inventories');
    }

    public function update($id)
    {
        $vendors = Vendor::get();
        $branches = Branch::get();
        $categories = Category::get();
        $inventory = Inventory::find($id);
        return view('admin.products.update',['vendors'=>$vendors,'inventory'=>$inventory,'branches'=>$branches,'categories'=>$categories]);
    }

    public function update_submit(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'code'          => 'required',
            'model'         => 'required',
            'condition'     => 'required',
            'category_id'   => 'required',
            'target'        => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            $messages="";
            foreach($errors as $error){
                $messages .= $error[0];
            }
            return '<script>alert("' . $messages . '")</script>';
        }

        $target         = $request->input('target');
        $code           = $request->input('code');
        $model          = $request->input('model');
        $category_id    = $request->input('category_id');
        $serial         = $request->input('serial');
        $condition      = $request->input('condition');
        $invoice_number = $request->input('invoice_number');
        $vendor         = $request->input('vendor');
        $color          = $request->input('color');
        $accessary      = $request->input('accessary');
        $description    = $request->input('description');
        $remark         = $request->input('remark');
        $invoice_date   = $request->input('invoice_date');
        $price  = $request->input('price');


        // Object Create Field
        $inventory = Inventory::find($request->input('inventory_id'));

        $image = $request->file('image');
        if(!empty($image)){
            // return time() . '.' . $image->getClientOriginalExtension();
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'),$image_name);
            $inventory->image        = $image_name;
        }
        

        $inventory->code            = $code;
        $inventory->model           = $model;
        $inventory->category_id     = $category_id;
        $inventory->serial          = $serial;
        $inventory->condition       = $condition;
        $inventory->price           = $price;
        $inventory->invoice_number  = $invoice_number;
        $inventory->vendor_id       = $vendor;
        $inventory->color           = $color;
        $inventory->accessary       = $accessary;
        $inventory->description     = $description;
        $inventory->target          = $target;
        $inventory->remark          = $remark;
        $inventory->created_at      = $invoice_date;
        // $inventory->save();
        $inventory->save();
        return redirect('/inventories');
    }

    public function transfer($id)
    {
        $inventory_id = DB::table('inventories')->where('id', $id)->value('id');
        return $inventory_id;
    }

    public function delete($id)
    {

        $usages = InventoryUser::where('inventory_id',$id)->get();
        foreach($usages as $usage){
            $usage->delete();
        }
        $inventory = Inventory::find($id);
        $inventory->delete();
        return json_encode([
            'status' => 1,
            'message' => 'Delete succcessfully',
        ]);
    }
    public function autocomplete(Request $request)
    {
        $datas = Inventory::select('model')->where('model','LIKE','%{$request->terms}%')->get();
        return response()->json($datas);
    }

    public function live_search(Request $request)
    {       
        if($request->ajax()){
            if($request->get('searchQuery') != ''){
                $query = $request->get('searchQuery');
                $data = DB::table('inventories')
                        ->where('code','like','%' . $query . '%')
                        ->orWhere('model','like','%' . $query . '%')
                        ->orWhere('category_id','like','%' . $query . '%')
                        ->orWhere('description','like','%' . $query . '%')
                        ->orWhere('remark','like','%' . $query . '%')
                        ->orWhere('status','like','%' . $query . '%')
                        ->orderBy('code','asc')->get();
                return json_encode($data);
            }else{
                $data = DB::table('inventories')->take(10)->orderBy('code','asc')->get();
                return json_encode($data);
            }
        }
    }

    public function category_filter(Request $request)
    {       
        if($request->ajax()){
            if($request->get('selectedValues') != ''){
                $category = $request->get('selectedValues');
                $status = $request->get('status');
                $vendor = $request->get('vendor');
                // $branches = $request->get('branches');
                $data = DB::table('inventories')->select('*')
                            ->where('category_id',$category[0])
                            ->orderBy('code','asc');
                
                // Array Gender = 1
                if(count($category) == 1 && $status == null && $vendor == null){
                    if($category[0] == 'all'){
                        $data = DB::table('inventories')->select('*')->orderBy('code','asc');
                    }else{
                        $data;
                    }
                // Array Gender > 1
                }elseif(count($category) == 1 && $status !=null && $vendor==null){
                    if(count($status) == 1){
                        $data->where('status',$status[0])->orderBy('code','asc');
                    }else{
                        for($num = 0; $num<count($category); $num++){
                            $data->where('status',$status[$num])->orderBy('code','asc');
                        }
                    }
                }elseif(count($category) > 1){
                    for($num = 0; $num<count($category); $num++){
                        $data->orWhere('category_id',$category[$num])->orderBy('code','asc');
                    }
                }
                return json_encode($data->get());
            }else{
                $data = DB::table('inventories')->take(10)->orderBy('code','asc')->get();
                return json_encode($data);
            }
        }
    }
    public function model_filter(Request $request)
    {       
        if($request->ajax()){
            if($request->get('selectedValues') != ''){
                $models = $request->get('selectedValues');
                // $branches = $request->get('branches');
                $data = DB::table('inventories')->select('*')
                            ->where('model',$models[0])
                            ->orderBy('code','asc');
                
                // Array Gender = 1
                if(count($models) == 1){
                    if($models[0] == 'all'){
                        $data = DB::table('inventories')->select('*')->orderBy('code','asc');
                    }else{
                        $data;
                    }
                // Array Gender > 1
                }elseif(count($models) > 1){
                    for($num = 0; $num<count($models); $num++){
                        $data->orWhere('model',$models[$num])->orderBy('code','asc');
                    }
                }
                return json_encode($data->get());
            }else{
                $data = DB::table('inventories')->take(10)->orderBy('code','asc')->get();
                return json_encode($data);
            }
        }
    }

    public function status_filter(Request $request)
    {       
        if($request->ajax()){
            if($request->get('selectedValues') != ''){
                $status = $request->get('selectedValues');
                // $branches = $request->get('branches');
                $data = DB::table('inventories')->select('*')
                            ->where('status',$status[0])
                            ->orderBy('code','asc');
                
                // Array Gender = 1
                if(count($status) == 1){
                    if($status[0] == 'all'){
                        $data = DB::table('inventories')->select('*')->orderBy('code','asc');
                    }else{
                        $data;
                    }
                // Array Gender > 1
                }elseif(count($status) > 1){
                    for($num = 0; $num<count($status); $num++){
                        $data->orWhere('status',$status[$num])->orderBy('code','asc');
                    }
                }
                return json_encode($data->get());
            }else{
                $data = DB::table('inventories')->take(10)->orderBy('code','asc')->get();
                return json_encode($data);
            }
        }
    }


    public function vendor_filter(Request $request)
    {       
        if($request->ajax()){
            if($request->get('selectedValues') != ''){
                $vendor = $request->get('selectedValues');
                // $branches = $request->get('branches');
                $data = DB::table('inventories')->select('*')
                            ->where('vendor_id',$vendor[0])
                            ->orderBy('code','asc');
                
                // Array Gender = 1
                if(count($vendor) == 1){
                    if($vendor[0] == 'all'){
                        $data = DB::table('inventories')->select('*')->orderBy('code','asc');
                    }else{
                        $data;
                    }
                // Array Gender > 1
                }elseif(count($vendor) > 1){
                    for($num = 0; $num<count($vendor); $num++){
                        $data->orWhere('vendor_id',$vendor[$num])->orderBy('code','asc');
                    }
                }
                return json_encode($data->get());
            }else{
                $data = DB::table('inventories')->take(10)->orderBy('code','asc')->get();
                return json_encode($data);
            }
        }
    }
    public function invoice_filter(Request $request)
    {       
        if($request->ajax()){
            if($request->get('selectedValues') != ''){
                $invoice = $request->get('selectedValues');
                // $branches = $request->get('branches');
                $data = DB::table('inventories')->select('*')
                            ->where('invoice_number',$invoice[0])
                            ->orderBy('code','asc');
                
                // Array Gender = 1
                if(count($invoice) == 1){
                    if($invoice[0] == 'all'){
                        $data = DB::table('inventories')->select('*')->orderBy('code','asc');
                    }else{
                        $data;
                    }
                // Array Gender > 1
                }elseif(count($invoice) > 1){
                    for($num = 0; $num<count($invoice); $num++){
                        $data->orWhere('invoice_number',$invoice[$num])->orderBy('code','asc');
                    }
                }
                return json_encode($data->get());
            }else{
                $data = DB::table('inventories')->take(10)->orderBy('code','asc')->get();
                return json_encode($data);
            }
        }
    }

    public function target_filter(Request $request)
    {       
        if($request->ajax()){
            if($request->get('selectedValues') != ''){
                $target = $request->get('selectedValues');
                // $branches = $request->get('branches');
                $data = DB::table('inventories')->select('*')
                            ->where('target',$target[0])
                            ->orderBy('code','asc');
                
                // Array Gender = 1
                if(count($target) == 1){
                    if($target[0] == 'all'){
                        $data = DB::table('inventories')->select('*')->orderBy('code','asc');
                    }else{
                        $data;
                    }
                // Array Gender > 1
                }elseif(count($target) > 1){
                    for($num = 0; $num<count($target); $num++){
                        $data->orWhere('target',$target[$num])->orderBy('code','asc');
                    }
                }
                return json_encode($data->get());
            }else{
                $data = DB::table('inventories')->take(10)->orderBy('code','asc')->get();
                return json_encode($data);
            }
        }
    }
    
}