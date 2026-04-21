<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plan extends Model
{
    use HasFactory;

    public $fillable = [
        'crop_id',
        'field_id',
        'year',
        'month',
        'action',
    ];

    public function crop():BelongsTo
    {
        return $this->belongsTo(Crop::class);
    }
    public function field():BelongsTo
    {
        return $this->belongsTo(Field::class);
    }
}
