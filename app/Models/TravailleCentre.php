<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravailleCentre extends Model
{
    use HasFactory;
    protected $table="travailleur_centre_interet";
    protected $fillable=['id_User','id_Centre'];

    public function centre()
        {
            return $this->belongsTo(CentreInteret::class,'id_Centre');
        }
}
