<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Layout extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_id',
        'title',
        'direction',
        'gap',
        'year',
        'memo',
    ];

    public function Field(): BelongsTo
    {
        return $this->belongsTo((Field::class));
    }
    
    public function Ridges(): HasMany
    {
        return $this->hasMany((Ridge::class));
    }

}
