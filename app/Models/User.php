<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Panel;
use App\Enums\UserGender;
use App\Enums\UserStatus;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'phone_verified_at',
        'otp_code',
        'status',
        'gender',
        'date_of_birth',
        'avatar',
        'referral_code',
        'fcm_token',
        'referrer_id',
        'password',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (User $user) {
            $user->status = UserStatus::ACTIVE;
            if (is_null($user->password)) {
                $user->password = bcrypt('password');
            }
        });
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'phone_verified_at' => 'datetime',
        'date_of_birth' => 'date',
        'status' => UserStatus::class,
        'gender' => UserGender::class,
        'password' => 'hashed',
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        return in_array($this->phone, config('constants.admin_phones'));
    }

    public function referrer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'referrer_id', 'id');
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(User::class, 'referrer_id', 'id');
    }
}
