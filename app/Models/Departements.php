<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departements extends Model
{
    use HasFactory;
    protected $table="departements";
    protected $fillable=['name','country_id'];

    public function pays()
    {
        return $this->belongsTo(Pays::class,'country_id');
    }
}
