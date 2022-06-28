<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_provider extends Model
{
    use HasFactory;
    protected $fillable=['name','email','description','image','product_name','deleted_at','status'];
}
