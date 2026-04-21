<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Ridge extends Model
{
    use HasFactory;

    protected $fillable = [
        'layout_id',
        'name',
        'size',
        'position',
    ];

    public function layout(): BelongsTo {
        return $this->belongsTo(Layout::class);
    }

    public function ridgeDetails(): HasMany {
        return $this->hasMany(RidgeDetail::class);
    }

}
