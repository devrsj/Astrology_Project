<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


use Redirect;

class Page extends Model
{
    use HasFactory;
    
    protected $fillable=['name','position','type','short_description','description','link','service','product','customer_section','parent_id','icon','banner','thumbnail','display_type','weight','status',
    'meta_title','meta_description','meta_keyword','slug'];
 










}
