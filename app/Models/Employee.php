<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Employee extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'image', 'name', 'phone', 'division_id', 'position',
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = Str::uuid();
        });
    }

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
