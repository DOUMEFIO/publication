<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tache extends Model
{
    use HasFactory;
    protected $table = "tache";
    protected $fillable = [
        'idClient', 'vueRecherche', 'debut', 'fin', 'fichier', 'description',
        'typetache', 'idStatus'
    ];

    public static function createTache($data, $user_id,$img)
    {
        return self::create([
            'idClient' => $user_id,
            'vueRecherche' => $data["vueRecherche"],
            'debut' => $data["debut"],
            'fin' => $data["fin"],
            'fichier' => $img,
            'description' => $data["description"],
            'typetache' => $data["typetache"],
            'idStatus' => 1
        ]);
    }



    public static function associateCentre($idtache, $centre)
    {
        $centres = [];
        foreach ($centre as $value) {
            $centres[] = [
                'idTache' => $idtache,
                'idCentre' => $value,
            ];
        }
        DB::table('tache_centre')->insert($centres);
    }

    public function type()
    {
        return $this->belongsTo(TypeTache::class, 'typetache');
    }

    public function travailleur()
    {
        return $this->belongsTo(User::class, 'idClient');
    }

    public function travailleurs()
    {
        return $this->belongsToMany(User::class, "travailleur_tache", "idTache", "idtravailleur");
    }

    public function travailleurtaches()
    {
        return $this->belongsToMany(User::class, "tache_preve", "idTache", "idtravailleur")->withPivot("capture","totalVues");
    }
}
