<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DiaryDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'diary_id',
        'type',
        'memo',
        'position',
    ];

    public function diary() :BelongsTo
    {
        return $this->belongsTo(Diary::class);
    }

    public function diaryDetailCrop()
    {
        return $this->hasOne(DiaryDetailCrop::class);
    }

    public function diaryDetailPesticide()
    {
        return $this->hasOne(DiaryDetailPesticide::class);
    }

}

