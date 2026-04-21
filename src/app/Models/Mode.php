<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Mode extends Model
{
    protected $fillable = [
        'name',
        'label',
    ];

    public $timestamps = false;

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'mode_users')
            ->withPivot('started_at', 'ended_at')
            ->withTimestamps();
    }

    public function levels(): HasMany 
    {
        return $this->hasMany(Level::class);
    }

    public function modeUsers(): HasMany
    {
        return $this->hasMany(ModeUser::class);
    }
}
