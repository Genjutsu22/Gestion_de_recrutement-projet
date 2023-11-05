<?php

namespace App\Models;

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
        'cv',
        'lettre_motiv',
        'cin',
    ];

}

