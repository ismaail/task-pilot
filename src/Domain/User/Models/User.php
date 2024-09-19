<?php

declare(strict_types=1);

namespace Domain\User\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Domain\Card\Models\Card;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Support\Models\Concerns\HasFactory;

/**
 * @mixin IdeHelperUser
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\User\UserFactory> */
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'current_card_id',
        'current_card_at',
    ];

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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'current_card_at' => 'immutable_datetime',
        ];
    }

    /**
     * @return HasOne<Card>
     */
    public function currentCard(): HasOne
    {
        return $this->hasOne(Card::class, 'id', 'current_card_id');
    }
}
