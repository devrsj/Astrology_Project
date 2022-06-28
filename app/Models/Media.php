<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory; 

    protected $fillable=['gallery_type','image','name','image_link','video_url','caption','weight','meta_description','meta_title','meta_keyword',
    'status','slug','gallerycategory_id','icon'];

    
}
