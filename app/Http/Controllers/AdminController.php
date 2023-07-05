<?php

namespace App\Http\Controllers;
use App\Models\CentreInteret;
use App\Models\InfoInfluenceur;
use App\Models\Tache;
use App\Models\TravailleCentre;
use App\Models\TravailleurTache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
                ->select('tache.idStatus','type_tache.libelle as tache_libelle','users.nom','tache.debut','tache.fin','tache.fichier','tache.description',
                        'tache.typetache','tache.vueRecherche','status.libelle as status_libelle','tache.id as nbr','users.prenom','users.id','users.idProfil',
                    DB::raw('GROUP_CONCAT(DISTINCT centre_interet.libelle) as centre'),
                    DB::raw('GROUP_CONCAT(DISTINCT centre_interet.id) as idcentre'),
                    DB::raw('GROUP_CONCAT(DISTINCT pays.id) as idpays'),
                    DB::raw('GROUP_CONCAT(DISTINCT pays.name) as pays'),
                    DB::raw('GROUP_CONCAT(DISTINCT departements.id) as iddepartements'),
                    DB::raw('GROUP_CONCAT(DISTINCT departements.name) as departements'),
                    DB::raw('GROUP_CONCAT(DISTINCT villes.id) as idvilles'),
                    DB::raw('GROUP_CONCAT(DISTINCT villes.name) as villes'))
                ->groupBy('users.nom','tache.debut','tache.fin','tache.fichier','tache.description',
                'tache.typetache','tache_libelle','tache.idStatus','tache.vueRecherche','status_libelle','nbr','users.prenom','users.id','users.idProfil')
                ->where('users.idProfil',3)
                ->where('tache.idStatus',1)
                ->where('payement',"paye")
                ->get();
        return view('admin.taches', compact("taches"));
    }

    public function tachevalide(){
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
                ->select('tache.idStatus','type_tache.libelle as tache_libelle','users.nom','tache.debut','tache.fin','tache.fichier','tache.description',
                        'tache.typetache','tache.vueRecherche','status.libelle as status_libelle','tache.id as tacheid','users.prenom','users.id','users.idProfil',
                    DB::raw('GROUP_CONCAT(DISTINCT centre_interet.libelle) as centre'),
                    DB::raw('GROUP_CONCAT(DISTINCT pays.name) as pays'),
                    DB::raw('GROUP_CONCAT(DISTINCT departements.name) as departements'),
                    DB::raw('GROUP_CONCAT(DISTINCT villes.name) as villes'))
                ->groupBy('users.nom','tache.debut','tache.fin','tache.fichier','tache.description',
                'tache.typetache','tache_libelle','tache.idStatus','tache.vueRecherche','status_libelle','tacheid','users.prenom','users.id','users.idProfil')
                ->where('users.idProfil',3)
                ->where('tache.idStatus',2)
                ->where('payement',"paye")
                ->get();
        return view('admin.tachevalide', compact("taches"));
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

    public function tacheAttribut(Request $request,$id,$vues,
            $centre,$pay,$dep,$vil){
        DB::table('tache')->where('id', $id)->update(['idStatus' => 2]);
        $items = DB::table('info_influenceur')
                ->join('users', 'users.id', '=', 'info_influenceur.id_user')
                ->join('travailleur_centre_interet', 'travailleur_centre_interet.id_User', '=', 'info_influenceur.id_user')
                ->select('info_influenceur.*', 'users.nom','users.id as users',
                'travailleur_centre_interet.id_Centre')
                ->get();

                // Définir le nombre total de vues à sélectionner
    $totalVues = 100;
    $idCentreList = explode(",", $centre);
    $pay = explode(",", $pay);
    $dep = explode(",", $dep);
    $vil = explode(",", $vil);;
    if (empty($pay[0])) {
        $pay = [];
    } else {
        $pay = array_filter(array_map('intval', $pay));
    }

    if (empty($dep[0])) {
        $dep = [];
    } else {
        $dep = array_filter(array_map('intval', $dep));
    }

    if (empty($vil[0])) {
        $vil = [];
    } else {
        $vil = array_filter(array_map('intval', $vil));
    }
    $result = [];
    //dd($centre,$pay,$vil,$dep);
foreach ($items as $item) {
    if($idCentreList && !empty($pay)) {
    if (in_array($item->id_Centre, $idCentreList) && in_array($item->id_pay, $pay)) {
        $result[] = [
            'moi'=>'pay',
            'nom'=>$item->nom,
            'centre'=>$item->id_Centre,
            'vue'=>$item->nbr_vue_moyen,
            'pay'=>$item->id_pay,
            'users'=>$item->users
        ];
    }
    } elseif($idCentreList && !empty($dep)) {
    if (in_array($item->id_Centre, $idCentreList) && in_array($item->id_departement, $dep)) {
        $result[] = [
            'moi'=>'dep',
            'nom'=>$item->nom,
            'centre'=>$item->id_Centre,
            'departement'=>$item->id_departement,
            'vue'=>$item->nbr_vue_moyen,
            'users'=>$item->users
        ];
    }
    } elseif($idCentreList && !empty($vil)) {
    if (in_array($item->id_Centre, $idCentreList) && in_array($item->id_ville, $vil)) {
        $result[] = [
            'moi'=>'ville',
            'nom'=>$item->nom,
            'centre'=>$item->id_Centre,
            'vil'=>$item->id_ville,
            'vue'=>$item->nbr_vue_moyen,
            'users'=>$item->users
        ];
    }
    }
    }
        $total=0;
            foreach ($result as $item) {
            $total += $item['vue'];
            }
//Affectation

$totalvues=0;
$vue = intval($vues);
//dd($result,$vue ,$total);
//$vue=100;// Valeur de référence
$selectedElement = null;
$tableau=[];
$closestGreaterElement = null;
$closestLowerElement = null;
$closestGreaterDifference = PHP_INT_MAX;
$closestLowerDifference = PHP_INT_MAX;

if($vue<$total){
    foreach ($result as $element) {
        if ($element['vue'] === $vue) {
            $selectedElement = $element;
            break;
            dd($$selectedElement);
        } elseif ($element['vue'] > $vue) {
            $difference = $element['vue'] - $vue;
            if ($difference < $closestGreaterDifference) {
                $closestGreaterDifference = $difference;
                $closestGreaterElement = $element;
            }
        } else {
            $difference = $vue - $element['vue'];
            if ($difference < $closestLowerDifference) {
                $closestLowerDifference = $difference;
                $closestLowerElement = $element;
            }
        }
    }

    if ($selectedElement !== null) {
        $selectedInformation = $selectedElement;
        TravailleurTache::create([
            'idtravailleur'=>$selectedInformation["users"],
            'idTache'=>$id,
            'idAdmin'=>Auth::user()->id
        ]);
    } elseif ($closestGreaterElement !== null) {
        $selectedInformation = $closestGreaterElement;
        TravailleurTache::create([
            'idtravailleur'=>$selectedInformation["users"],
            'idTache'=>$id,
            'idAdmin'=>Auth::user()->id
        ]);
    } elseif ($closestLowerElement !== null) {
        $selectedInformation = $closestLowerElement;
        $totalvues+=$closestLowerElement["vue"];
        $restevues=$vue-$closestLowerElement["vue"];
        $index = array_search($closestLowerElement, $result);
        unset($result[$index]);

        do {
            $ty = $vue - $totalvues;
            $closestDifference = PHP_INT_MAX;
            $selectedIndex = null;

            foreach ($result as $index => $element) {
                $difference = abs($element['vue'] - $ty);
                if ($difference < $closestDifference) {
                    $closestDifference = $difference;
                    $closestLowerElement = $element;
                    $selectedIndex = $index;
                }
            }

            if ($closestLowerElement !== null) {
                $totalvues += $closestLowerElement['vue'];
                $tableau[] = $closestLowerElement;
                unset($result[$selectedIndex]);
                $result = array_values($result);
            }
        } while ($totalvues < $vue);
        $selectedInformation=array_merge([$selectedInformation], $tableau);
        //dd($selectedInformation);
        foreach ($selectedInformation as $isset) {
//print_r($isset);
            TravailleurTache::create([
                'idtravailleur'=>$isset["users"],
                'idTache'=>$id,
                'idAdmin'=>Auth::user()->id
            ]);
        }
    } else{
        //A gerer après
        $selectedInformation = "234y";
    }
} else{
    $selectedInformation="rtyuu";
}
        //dd($result,$id,$vues,$selectedInformation,$total);

        return redirect()->route("admin.tache");
    }

    public function distribuer(){
        $taches=TravailleurTache::all();
        return view("admin.attribuerTache", compact("taches"));
    }
}
