<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offre_emploi extends Model
{
    use HasFactory;
    protected $table = 'offre_emploi';
    protected $primaryKey = 'id_offre';
    public $timestamps = false;

    protected $fillable = [
        'id_prof',
        'details',
        'type_emploi',
        'date_pub',
        'date_termine',
        'termine',
    ];

    public function profession()
    {
        return $this->belongsTo(profession::class, 'id_prof', 'id_prof');
    }
    
}
