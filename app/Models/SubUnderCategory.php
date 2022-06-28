<?php

namespace App\Models;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubUnderCategory;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SubUnderCategory extends Model
{
    use HasFactory;

    protected $fillable=['name','category_id','stock','subcategory_id','short_description','price','description','banner','image','favicon','meta_title',
    'meta_description','weight','status','slug'];
    //

    public function category(){
        return $this->belongsTo(Category::class);

    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }

    public function products(){
        return $this->hasMany(Product::class,'subcategory_id','id');
    }
    
    
       
    
    
}
