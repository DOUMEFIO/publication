<?php

namespace App\Http\Controllers;
use App\Models\CentreInteret;
use App\Models\InfoInfluenceur;
use App\Models\Tache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index(){
        $centreInterets=CentreInteret::all();
        return view('admin.index', compact("centreInterets"));
    }

    public function tache(){
        $taches = DB::table('tache')
                ->leftJoin('users', 'tache.idClient', '=', 'users.id')
                ->leftJoin('tache_zone', 'tache.id', '=', 'tache_zone.idTache')
                ->leftJoin('tache_centre', 'tache.id', '=', 'tache_centre.idTache')
                ->leftJoin('villes', 'tache_zone.idVille', '=', 'villes.id')
                ->leftJoin('pays', 'tache_zone.idPay', '=', 'pays.id')
                ->leftJoin('departements', 'tache_zone.idDepartement', '=', 'departements.id')
                ->leftJoin('status', 'tache.idStatus', '=', 'status.id')
                ->leftJoin('centre_interet', 'tache_centre.idCentre', '=', 'centre_interet.id')
                ->leftJoin('type_tache', 'tache.typetache', '=', 'type_tache.id')
                ->select('type_tache.libelle as tache_libelle','users.nom','tache.debut','tache.fin','tache.fichier','tache.description',
                        'tache.typetache','tache.vueRecherche','status.libelle as status_libelle','tache.id','users.prenom','users.id','users.idProfil',
                    DB::raw('GROUP_CONCAT(DISTINCT centre_interet.libelle) as centre'),
                    DB::raw('GROUP_CONCAT(DISTINCT pays.name) as pays'),
                    DB::raw('GROUP_CONCAT(DISTINCT departements.name) as departements'),
                    DB::raw('GROUP_CONCAT(DISTINCT villes.name) as villes'))
                ->groupBy('users.nom','tache.debut','tache.fin','tache.fichier','tache.description',
                'tache.typetache','tache_libelle','tache.vueRecherche','status_libelle','tache.id','users.prenom','users.id','users.idProfil')
                ->where('users.idProfil',3)
                ->get();
        return view('admin.taches', compact("taches"));
    }

    public function createCentre(){
        return view('admin.centreCreate');
    }

    public function centreStore(Request $request){
        CentreInteret::create([
            "libelle"=>$request->libelle,
        ]);
        return redirect()->route("admin.index");
    }

    public function tacheAttribut(){
        $users=InfoInfluenceur::all();
        return view("admin.attribuerTache", compact("users"));
    }
}
