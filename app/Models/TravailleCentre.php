<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TravailleCentre extends Model
{
    use HasFactory;
    protected $table="travailleur_centre_interet";
    protected $fillable=['id_User','id_Centre'];

    public function centre()
        {
            return $this->belongsTo(CentreInteret::class,'id_Centre');
        }

    public function infoinfluenceur()
        {
            return $this->belongsTo(InfoInfluenceur::class,'id_User');
        }

    public static function userCentre($user_id, $centre){
        $centres=[];
        foreach ($centre as $value) {
            $centres[] = [
                'id_User' => $user_id,
                'id_Centre' => $value,
            ];
        }
        DB::table('travailleur_centre_interet')->insert($centres);
    }
}
