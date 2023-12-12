<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{BelongsToMany, HasMany, HasOne};
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // create wallet by default when this class be called.
    protected static function booted()
    {
        static::created(function ($user) {
            $user->createWallet();
        });
    }

    public function createWallet()
    {
        return $this->wallet()->create([
            'balance' => 0,
        ]);
    }

    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class);
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    } // usúario pode ter muitos eventos  1:N

    public function eventsAsParticipant(): BelongsToMany
    {
        return $this->belongsToMany(Event::class);
    } // usúario pode pertencer a muitos eventos 1:N

    public function contactInfo(): HasOne
    {
        return $this->hasOne(UserContactInfo::class, 'user_id');
    } // usúario pode ter uma relação apenas, 1:1 'endereço:phone..etc'

    public function transactions(): HasOne
    {
        return $this->hasOne(Transaction::class);
    }

    public function accountBanking(): HasOne
    {
        return $this->hasOne(BankAccount::class);
    }

}
