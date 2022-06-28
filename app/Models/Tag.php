<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Tag extends Model
{
    use HasFactory;
    protected $fillable=['name','weight','slug'];

    public function blogs(){
        return $this->belongsToMany(Blog::class);
    }
    

    
    
}
