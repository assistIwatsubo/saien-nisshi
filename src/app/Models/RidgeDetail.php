<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RidgeDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'ridge_id',
        'crop_id',
        'ratio',
        'position',
    ];

    public function ridge(): BelongsTo 
    {
        return $this->belongsTo(Ridge::class);
    }

    public function crop(): BelongsTo
    {
        return $this->belongsTo(Crop::class);
    }

}
