<?php

namespace App\Models;

use App\Enums\AccountType;
use App\Enums\UserTitle;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',

        'account_type',
        'title',
        'first_name',
        'last_name',
        'dob',
        'sex',
        'bio',
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
            'account_type' => AccountType::class,
            'title' => UserTitle::class,
        ];
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class);
    }

    public function studentProfile(): HasOne
    {
        return $this->hasOne(Student::class);
    }

    public function tutorProfile(): HasOne
    {
        return $this->hasOne(Tutor::class);
    }

    public function scopeStudents($query)
    {
        return $query->where('account_type', AccountType::Student);
    }

    public function scopeTutors($query)
    {
        return $query->where('account_type', AccountType::Tutor);
    }
}
