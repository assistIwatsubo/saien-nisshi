<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Casts\Attribute;

class DiaryDetailCrop extends Model
{
    use HasFactory;

    protected $fillable = [
        'diary_detail_id',
        'crop_field_id',
    ];

    public function diaryDetail(): BelongsTo
    {
        return $this->belongsTo(DiaryDetail::class);
    }

    public function cropField(): BelongsTo
    {
        return $this->belongsTo(CropField::class);
    }

}
