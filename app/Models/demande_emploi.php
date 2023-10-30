<?php

namespace App\Models;

use App\Candidat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class demande_emploi extends Model
{
    use HasFactory;
    protected $table = 'demande_emploi';
    protected $primaryKey =['id_candidat', 'id_offre'] ; // Since it's a composite primary key
    public $incrementing = false; // Disable auto-incrementing primary key
    public $timestamps = false;

    protected $fillable = [
        'id_candidat',
        'id_offre',
        'date_entretien',
        'accepted',
    ];

    public function candidat()
    {
        return $this->belongsTo(candidat::class, 'id_candidat', 'id_candidat');
    }

    public function offreEmploi()
    {
        return $this->belongsTo(offre_emploi::class, 'id_offre', 'id_offre');
    }
}
