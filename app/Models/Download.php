<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Download extends Model
{
    protected $fillable = ['title', 'file', 'type'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
