<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Crop extends Model
{
    protected $fillable = [
        'name',
    ];

    public function profiles(): BelongsTo 
    {
        return $this->belongsTo(Profile::class);
    }

    public function cropFields(): HasMany  
    {
        return $this->hasMany(CropField::class);    
    }

    public function plans(): HasMany
    {
        return $this->hasMany(Plan::class);
    }

}
