<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

         protected $fillable = [
        'order_number', 'user_id', 'guest_id','status', 'grand_total', 'item_count', 'payment_status', 'payment_method',
      'delivery','name', 'email', 'address', 'city', 'country', 'post_code', 'phone_number'];



}
