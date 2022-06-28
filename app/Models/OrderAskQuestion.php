<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderAskQuestion extends Model
{
    use HasFactory;
    
    protected $fillable=['order_code','guest_id','user_id','name','email','number','gender','occupation','category_id','grand_total','payment_status',
    'payment_method','status','remarks'];
   
    public function category(){
        return $this->belongsTo(Category::class);
    }

}
