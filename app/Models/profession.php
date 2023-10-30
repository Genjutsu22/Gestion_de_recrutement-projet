<?php

namespace App\Models;

use App\Departement;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profession extends Model
{
    use HasFactory;
    protected $table = 'profession';
    protected $primaryKey = 'id_prof';
    public $timestamps = false;

    protected $fillable = [
        'id_depart',
        'nom_prof',
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_depart', 'id_depart');
    }

}
