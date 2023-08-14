<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TachePreuve extends Model
{
    use HasFactory;
    protected $table="tache_preve";
    protected $fillable=['idtravailleur','idTache','totalVues','capture'];

    public function infotache()
        {
            return $this->belongsTo(Tache::class,'idTache');
        }
}
