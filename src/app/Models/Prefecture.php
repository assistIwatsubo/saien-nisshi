<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prefecture extends Model
{
    protected $fillable = [
        'name',
        'region',
    ];

    public $timestamps = false;

    public function profiles(): HasMany {
        return $this->hasMany(Profile::class);
    }
}
