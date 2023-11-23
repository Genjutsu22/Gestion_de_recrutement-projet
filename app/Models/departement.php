<?php

namespace App;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Departement extends Model
{
    use HasFactory;
    protected $table = 'departement';
    protected $primaryKey = 'id_depart';
    public $timestamps = false;

    protected $fillable = [
        'nom_depart',
    ];
    public function professions()
    {
        return $this->hasMany(Profession::class);
    }

}