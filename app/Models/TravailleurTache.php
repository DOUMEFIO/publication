<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravailleurTache extends Model
{
    use HasFactory;
    protected $table="travailleur_tache";
    protected $fillable=['idtravailleur','idTache','totalVues','idAdmin'];

    public function tacheall()
        {
            return $this->belongsTo(Tache::class,'idTache');
        }

    public function user()
    {
        return $this->belongsTo(User::class,'idtravailleur');
    }
}
