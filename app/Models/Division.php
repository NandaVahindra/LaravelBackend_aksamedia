<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Division extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
    ];

    protected static function boot()
    {
        parent::boot();

        // Generate UUID for the primary key before creating a new record
        self::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }
}
