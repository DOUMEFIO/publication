<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoInfluenceur extends Model
{
    use HasFactory;
    protected $table="info_influenceur";
    protected $fillable=['id_User','tel','nbr_vue_moyen','sexe',
                        'id_pay','id_departement','id_ville'];

    public function type()
        {
            return $this->belongsTo(User::class,'id_User');
        }

    public function residencepay()
        {
            return $this->belongsTo(Pays::class,'id_pay');
        }

    public function residencedep()
        {
            return $this->belongsTo(Departements::class,'id_departement');
        }

    public function residencevil()
        {
            return $this->belongsTo(Villes::class,'id_ville');
        }
}
