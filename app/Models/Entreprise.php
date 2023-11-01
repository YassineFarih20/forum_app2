<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Entreprise extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;
    use HasFactory;
    protected $table = 'entreprises';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->password = Hash::make(strtoupper(str_replace(" ", "", $model->representant)) . "123@");
        });
    }

    protected $hidden = [
        'password',
    ];
    protected $casts = [
        'password' => 'hashed',
    ];

    protected $fillable = [
        'representant',
        'raisonabregee',
        'raisonsociale',
        'logo',
        'web',
        'email',
    ];
}
