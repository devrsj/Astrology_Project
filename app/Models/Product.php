<?php

namespace App\Models;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;    

 protected $fillable=['name','category_id','subcategory_id','subundercategory_id','short_description','description','banner','image','image1','image2','image3','quantity','mp',
 'sp','favicon','meta_title','meta_description','weight','status','slug'];
    
   
    public function category(){
    return $this->belongsTo(Category::class);
    }


   public  function subcategory(){
       return $this->belongsTo(Subcategory::class);
   }


   public function subundercategory(){
      return $this->belongsTo(Subundercategory::class);
  }

  public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

  

}
