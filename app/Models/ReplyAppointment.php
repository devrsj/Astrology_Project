<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyAppointment extends Model
{
    use HasFactory;
    protected $fillable=['orderappointment_id','user_id','preferred_date','preferrred_time','status'];
}
