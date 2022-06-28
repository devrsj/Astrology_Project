<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FranchiseRequest extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable=[
        'name',
        'company_name',
        'email',
        'contact_number',
        'city',
        'state',
        'postal',
        'country',
        'comment',

    ];
}
