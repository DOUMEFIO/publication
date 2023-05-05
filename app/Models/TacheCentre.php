<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TacheCentre extends Model
{
    use HasFactory;
    protected $table="tache_centre";
    protected $fillable=['idTache','idCentre'];
}
