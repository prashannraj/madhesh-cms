<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = ['name', 'designation', 'photo', 'bio', 'priority', 'is_active'];
}
