<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravailleurTache extends Model
{
    use HasFactory;
    protected $table="travailleur_tache";
    protected $fillable=['idtravailleur','idTache','totalVues','capture','dateValidation','idAdmin'];

    public function tacheall()
        {
            return $this->belongsTo(Tache::class,'idTache');
        }
}
