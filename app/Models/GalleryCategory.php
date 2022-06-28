<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $fillable=['name','description','thumbnail','banner',
    'meta_title','meta_description','weight','status','slug'];
}
