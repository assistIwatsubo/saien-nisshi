<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Diary extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_id',
        'date',
        'title',
        'summary'
    ];

    public static function findByUserAndDate(string $userId, string $date): ?Diary
    {
        return self::where('user_id', $userId)
                   ->where('date', $date)
                   ->first();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function diaryDetails(): HasMany
    {
        return $this->hasMany(DiaryDetail::class);
    }

}

