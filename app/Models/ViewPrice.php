<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViewPrice extends Model
{
    use HasFactory;
    protected $table="view_price";
    protected $fillable=['idTache','prixtache','prixinfluenceur'];
}
