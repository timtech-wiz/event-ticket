<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'google_id'])]
#[Hidden([
    'password',
    'remember_token',
    'spotify_access_token',
    'spotify_refresh_token',
    'spotify_expires_at'
    ])
]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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
            'spotify_access_token' => 'encrypted',
            'spotify_refresh_token' => 'encrypted',
            'spotify_expires_at' => 'datetime',
        ];
    }

    protected $hidden = [
        'password',
        'remember_token',

    ];

    public function updateSpotifyOAuthDetails(
        string $accessToken,
        string $refreshToken,
        \DateTimeImmutable $expiresAt
    ): void {
        $this->spotify_access_token = $accessToken;
        $this->spotify_refresh_token = $refreshToken;
        $this->spotify_expires_at = $expiresAt;

        $this->save();
    }

    public function isConnectedToSpotify(): bool
    {
        return $this->spotify_access_token
            && $this->spotify_refresh_token
            && $this->spotify_expires_at;
    }
}
