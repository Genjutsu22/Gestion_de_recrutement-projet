<?php

namespace App;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class candidat extends Model
{
    use HasFactory;
    protected $table = 'candidat';
    protected $primaryKey = 'id_candidat';
    public $timestamps = false;

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'password',
        'adresse',
        'OTP',
        'OTP_expiry',
        'cin',
    ];

}

