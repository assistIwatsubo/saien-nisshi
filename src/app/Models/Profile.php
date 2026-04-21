<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nickname',
        'favorite_crop_id',
        'helper_character_id',
        'prefecture_id',
    ];

    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function favoriteCrop(): BelongsTo
    {
        return $this->belongsTo(Crop::class, 'favorite_crop_id');
    }

    public function helperCharacter(): BelongsTo
    {
        return $this->belongsTo(HelperCharacter::class);
    }

    public function prefecture(): BelongsTo
    {
        return $this->belongsTo(Prefecture::class);
    }
}
