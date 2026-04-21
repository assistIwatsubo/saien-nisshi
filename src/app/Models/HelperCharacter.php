<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HelperCharacter extends Model
{
    protected $fillable = [
        'name',
        'image_url',
        'description',
    ];

    public function profiles(): HasMany
    {
        return $this->hasMany(Profile::class);
    }
}
