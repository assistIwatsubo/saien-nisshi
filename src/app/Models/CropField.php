<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CropField extends Model
{

    use HasFactory;

    protected $fillable = [
        'crop_id',
        'field_id',
    ];

    public function crop():BelongsTo 
    {
        return $this->belongsTo(Crop::class);
    }

    public function field():BelongsTo 
    {
        return $this->belongsTo(Field::class);
    }

    public function diaryDetailCrops():HasMany 
    {
        return $this->hasMany(DiaryDetailCrop::class);
    }

    public function diaryDetailPesticides():HasMany 
    {
        return $this->hasMany(DiaryDetailPesticide::class);
    }
}
