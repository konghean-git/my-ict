<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','map_link','city','country'];
    // public function employees()
    // {
    //     return $this->hasMany(Employee::class);
    // }
}
