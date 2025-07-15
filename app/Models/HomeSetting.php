<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    protected $fillable = ['hero_title', 'welcome_text', 'seo_title', 'seo_description'];
}
