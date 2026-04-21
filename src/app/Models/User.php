<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Casts\Attribute;


class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'user_slug',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    // protected $appends = [
    //     'currentModeData',
    // ];

    // JWTSubject用メソッド
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class);
    }

    public function fields(): HasMany
    {
        return $this->hasMany(Field::class);
    }

    public function diaries(): HasMany 
    {
        return $this->hasMany(Diary::class);
    }

    public function schedules(): HasMany 
    {
        return $this->hasMany(Schedule::class);
    }

    public function followings(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followings', 'user_id', 'following_id');
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followings', 'following_id', 'user_id');
    }

    public function modeUsers(): HasMany
    {
        return $this->hasMany(ModeUser::class);
    }

    protected function currentModeData(): Attribute
    {
        return Attribute::get(function () {
            // 現在進行中のModeUser
            $current = $this->modeUsers()
                            ->where(function ($q) {
                                $q->whereNull('ended_at')
                                ->orWhere('ended_at', '>=', now());
                            })
                            ->latest('started_at')
                            ->first();

            if (!$current) {
                return [
                    'mode' => null,
                    'durationDays' => 0,
                ];
            }

            $mode = $current->mode;
            $modeId = $mode->id;

            // 過去にそのモードを選択した全レコードの累計日数
            $totalDays = $this->modeUsers()
                            ->where('mode_id', $modeId)
                            ->get()
                            ->sum(function ($mu) {
                                $end = $mu->ended_at ?? now();
                                return (int) $mu->started_at->diffInDays($end, false);
                            });

            return [
                'mode' => $mode,
                'durationDays' => $totalDays,
            ];
        });
    }

}
