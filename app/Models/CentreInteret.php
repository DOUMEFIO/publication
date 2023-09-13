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

    public function centres()
    {
        return $this->hasMany(TacheCentre::class);
    }
}
