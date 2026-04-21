<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Level extends Model
{
    protected $fillable = [
        'level',
        'mode_id',
        'description',
        'benchmark',
    ];

    protected $casts = [
        'benchmark' => 'array',
    ];

    public function mode(): BelongsTo 
    {
        return $this->belongsTo(Mode::class);
    }
}
