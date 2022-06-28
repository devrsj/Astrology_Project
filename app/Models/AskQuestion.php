<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AskQuestion extends Model
{
    use HasFactory;

    protected $fillable=['category_id','question','price'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
