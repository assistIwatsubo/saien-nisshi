<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesticide extends Model
{
    protected $fillable = [
        'name',
    ];

    public function diaryDetailPesticides(): HasMany {
        return $this->hasMany(DiaryDetailPesticide::class);
    }
}
