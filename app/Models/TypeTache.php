<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTache extends Model
{
    use HasFactory;
    protected $table="type_tache";
    protected $fillable=[
        'libelle'];

    public function tache()
    {
        return $this->hasMany(Tache::class);
    }
}
