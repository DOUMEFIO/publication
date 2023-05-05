<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    use HasFactory;
    protected $table="tache";
    protected $fillable=['idClient','vueRecherche','debut','fin','fichier','description',
                        'typetache','idStatus'];

        public function type()
        {
            return $this->belongsTo(TypeTache::class,'typetache');
        }
}
