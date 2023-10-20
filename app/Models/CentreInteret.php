<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentreInteret extends Model
{
    use HasFactory;
    protected $table="centre_interet";
    protected $fillable=['libelle'];

    public function travaille()
    {
        return $this->hasMany(TravailleCentre::class);
    }

    public function taches(){
        return $this->belongsToMany(Tache::class, "tache_centre", "idCentre", "idTache");
    }

    public function users(){
        return $this->belongsToMany(User::class, "travailleur_centre_interet", "id_Centre", "id_User");
    }
}
