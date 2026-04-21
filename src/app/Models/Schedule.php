<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;


class Schedule extends Model
{

    use HasFactory, Notifiable; 
    
    protected $fillable = [
        'title',
        'start',
        'end',
        'status_id',
        'memo',
    ];

    public function status()
    {
        return $this->belongsTo(ScheduleStatus::class, 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
