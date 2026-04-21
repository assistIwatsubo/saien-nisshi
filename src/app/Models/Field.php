<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'ratio'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function cropFields(): HasMany
    {
        return $this->hasMany(CropField::class);
    }

    public function plans(): HasMany
    {
        return $this->hasMany(Plan::class)->orderBy('month');
    }
    
    public function layouts(): HasMany 
    {
        return $this->hasMany(Layout::class);
    }
}