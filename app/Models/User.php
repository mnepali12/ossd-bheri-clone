<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'role_id',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function announcements(): HasMany
    {
        return $this->hasMany(Announcement::class, 'created_by');
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class, 'student_id');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'student_id');
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class, 'user_id');
    }

    public function hasRole(string $role): bool
    {
        return $this->role && $this->role->name === $role;
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('Admin');
    }

    public function isStaff(): bool
    {
        return $this->hasRole('Staff');
    }

    public function isStudent(): bool
    {
        return $this->hasRole('Student');
    }
}
