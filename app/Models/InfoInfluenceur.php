<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoInfluenceur extends Model
{
    use HasFactory;
    protected $table="info_influenceur";
    protected $fillable=['id_User','tel','nbr_vue_moyen','sexe',
                        'id_pay','id_departement','id_ville'];

    public function type()
        {
            return $this->belongsTo(User::class,'id_User');
        }

    public function residencepay()
        {
            return $this->belongsTo(Pays::class,'id_pay');
        }

    public function residencedep()
        {
            return $this->belongsTo(Departements::class,'id_departement');
        }

    public function residencevil()
        {
            return $this->belongsTo(Villes::class,'id_ville');
        }

    public static function updateInfluenceur($data, $user){
        $tel = str_replace([' ', '(', ')', '+'], '', $data->tel);
        if (is_null($data->departement) && is_null($data->ville)) {
            $info = ([
                'sexe' => $data->sexe,
                'tel' => $tel,
                'nbr_vue_moyen' => $data->vuesmoyen,
                'id_pay' => $data->pay
            ]);
            self::where("id_user", $user)->update($info);
        } elseif (is_null($data->ville)) {
            $info = ([
                'sexe' => $data->sexe,
                'tel' => $tel,
                'nbr_vue_moyen' => $data->vuesmoyen,
                'id_pay' => $data->pay,
                'id_departement' => $data->departement
            ]);
            self::where("id_user", $user)->update($info);
        }
        else {
            $info = ([
                'sexe' => $data->sexe,
                'tel' => $tel,
                'nbr_vue_moyen' => $data->vuesmoyen,
                'id_pay' => $data->pay,
                'id_departement' => $data->departement,
                'id_ville' => $data->ville
            ]);
            self::where("id_user", $user)->update($info);
        }
    }

    public static function createInfoInfluenceur($data, $user){
        $tel = str_replace([' ', '(', ')', '+'], '', $data->tel);
        self::create([
            'id_User' => $user,
            'tel' => $tel,
            'nbr_vue_moyen' => $data->nbr_vue_moyen,
            'sexe' => $data->sexe,
            'id_pay' => $data->pay,
            'id_departement' => $data->departement,
            'id_ville' => $data->ville
        ]);
    }
}
