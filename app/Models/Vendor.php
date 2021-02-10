<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable=['name','contact','address','inventory_id'];

    public function inventtories()
    {
        return $this->hasMany(Inventory::class,'inventory_id');
    }

}
