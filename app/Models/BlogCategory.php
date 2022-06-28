<?php

namespace App\Models;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogCategory extends Model
{
    use HasFactory;



protected $fillable=['name','banner',
    'meta_title','meta_description','weight','status','slug'];

    public function blogs(){
        return $this->hasMany(Blog::class,'category_id');
    }
    
    
  

}

 