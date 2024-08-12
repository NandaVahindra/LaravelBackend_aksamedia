<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'name',
        'username',
        'phone',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $model->id = (string) Str::uuid();
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
}
