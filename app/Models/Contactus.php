<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contactus extends Model
{
    use HasFactory;

       protected $fillable=['name','address','email','number','telephone_number','description','google_map','facebookpage_link'];



}
