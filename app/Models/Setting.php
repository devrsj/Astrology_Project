<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable=['navbar_logo','navbar_link','footer_logo','footer_link','facebook_link',
   'twitter_link','instagram_link','youtube_link','description'];
}
