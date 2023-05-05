<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $table="tache_zone";
    protected $fillable=['idTache','idPay','idDepartement','idVille'];

    public function lestaches()
        {
            return $this->belongsTo(User::class,'idTache');
        }

    public function residencepay()
        {
            return $this->belongsTo(Pays::class,'idPay');
        }

    public function residencedep()
        {
            return $this->belongsTo(Departements::class,'idDepartement');
        }

    public function residencevil()
        {
            return $this->belongsTo(Villes::class,'idVille');
        }
}
