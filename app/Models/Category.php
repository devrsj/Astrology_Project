<?php

namespace App\Models;

use App\Models\Product;
use App\Models\SubUnderCategory;
use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

     protected $fillable=['name','banner','icon','status','position','description','thumbnail',
    'meta_title','meta_keyword','meta_description','weight','slug'];
    //

    public function subcategories()
    {
        return $this->hasMany(SubCategory::class);
    }
    
    public function subundercategories()
    {
        return $this->hasMany(Subundercategory::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
    
 
    
    
}
