<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReplyQuestion extends Model
{
    use HasFactory;

    protected $fillable=['orderquestion_id','guest_id','user_id','question','answer'];
}
