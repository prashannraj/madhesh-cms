<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Notice;
use App\Models\Download;


class Category extends Model
{
    protected $fillable = ['title', 'thumbnail', 'is_published'];

    public function notices(): HasMany
    {
        return $this->hasMany(Notice::class);
    }
    public function download(): HasMany
    {
        return $this->hasMany(Download::class);
    }


}
