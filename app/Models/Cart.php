<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable=['id','order_id','product_name','product_id','user_id','guest_id','quantity','price','sub_total'];


 public function products()
    {
        return $this->hasMany(Product::class);
    }
    


}
