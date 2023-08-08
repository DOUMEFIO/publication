<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villes extends Model
{
    use HasFactory;
    protected $table="villes";
    protected $fillable=['name','state_id'];

    public function departements()
        {
            return $this->belongsTo(Departements::class,'state_id');
        }
}
