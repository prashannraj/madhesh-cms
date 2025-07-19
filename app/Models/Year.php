<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Complain;


class Year extends Model
{
    //
    protected $fillable = ['title', 'is_published'];

    public function complains(): HasMany
    {
        return $this->hasMany(Complain::class);
    }
}
