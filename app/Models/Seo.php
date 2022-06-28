<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seo extends Model
{
    use HasFactory;
    protected $fillable=['webmaster','yandex','analaytic','geo_tag','og_tag','favicon','logo','meta_title','meta_keyword','meta_description'];

}
