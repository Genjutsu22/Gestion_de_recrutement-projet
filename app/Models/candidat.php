<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
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
    public static function updateExpiredOTP()
    {
        $expiredDateTime = Carbon::now()->subMinute();

        self::where('OTP_expiry', '<=', $expiredDateTime)
            ->update([
                'OTP' => null,
                'OTP_expiry' => null
            ]);
    }

}

