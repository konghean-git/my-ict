<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;
    protected $fillable = ['code','model','description','remark','vendor_id','price','serial','condition','status','image','color','target','invoice_number','accessary'];
    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
    public function users()
    {
        return $this->belongsToMany(User::class,'inventory_user','inventory_id','user_id')
        ->withTimestamps()
        ->withPivot('reference_id','preparer_id','delivery_node_code','condition','accessary','is_normal_user','is_printed','is_using','inventory_description','usage_description','started_at','finished_at')
        ->using(InventoryUser::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class,'vendor_id');
    }
}