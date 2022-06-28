<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable=[ 'user_id','name','email','phone','gender','preferred_date','preferrred_time','dob','service','sub_service',
    'tob',
    'birth_place',
    'state',
    'country_birth',
    'consultation_service',
    'remarks','status'];
}
