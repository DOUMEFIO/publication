<?php

    namespace App\Http\Controllers;
    use App\Models\CentreInteret;
    use App\Models\Departements;
    use App\Models\InfoInfluenceur;
    use App\Models\Pays;
    use App\Models\Tache;
    use App\Models\TravailleCentre;
    use App\Models\TravailleurTache;
    use App\Models\TypeTache;
    use App\Models\User;
    use App\Models\Villes;
    use App\Models\Zone;
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
                //dd($taches);
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
        //dd($id,$vues,$centre,$pay,$dep,$vil);
        $listcentre = explode("," , $centre);
        $listpay = explode("," , $pay);
        $listdep = explode("," , $dep);
        $listvil = explode("," , $vil);
        $items = InfoInfluenceur::join('users', 'users.id', '=', 'info_influenceur.id_user')
            ->join('travailleur_centre_interet', 'travailleur_centre_interet.id_User', '=', 'info_influenceur.id_user')
            ->select('info_influenceur.*', 'users.nom','users.id as users','users.idprofil',
                'travailleur_centre_interet.id_Centre')
            ->where('users.idprofil' , 2)
            ->whereIn('id_Centre' , $listcentre)
            ->whereIn('id_pay' , $listpay)
            ->orwhereIn('id_departement' , $listdep)
            ->orwhereIn('id_ville' , $listvil)
             ->distinct()
            ->get();
            dd($items);
        $uniqueIds = [];
        $total = 0;
        foreach ($items as $item) {
            $userId = $item->id_User;
            // Vérifier si l'id_User existe déjà dans le tableau d'identifiants uniques
            if (!in_array($userId, $uniqueIds)) {
                $uniqueIds[] = $userId;
                $items = ([
                    "users" => $item->id_User,
                    "vue" => $item->nbr_vue_moyen
                ]);
                $uniqueItems[] = $items;
                $total += $item->nbr_vue_moyen;
            }
            dd( $uniqueItems);
        }
        $result = $uniqueItems;
        
        $totalvues=0;
        $vue = intval($vues);
        $selectedElement = null;
        $tableau=[];
        $closestGreaterElement = null;
        $closestLowerElement = null;
        $closestGreaterDifference = PHP_INT_MAX;
        $closestLowerDifference = PHP_INT_MAX; $selectedElement = null;
        //dd($vue, $total);
        if($vue<$total){
            foreach ($result as $element) {
                if ($element['vue'] === $vue) {
                    $selectedElement = $element;
                    break;
                    dd($selectedElement);
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

                foreach ($selectedInformation as $isset) {
                    TravailleurTache::create([
                        'idtravailleur'=>$isset["users"],
                        'idTache'=>$id,
                        'idAdmin'=>Auth::user()->id
                    ]);
                }
            }
        } else{
            if(!empty($listvil)){
                $alldepartements = Villes::whereIn("id",$listvil)->pluck("state_id")->implode(",");
                $alldepartements = explode(",", $alldepartements);
            } else{
                $alldepartements = "";
                $alldepartements = explode(",", $alldepartements);
            }
           $deptableau = array_merge($alldepartements, $listdep);
           //dd($deptableau);
           if(!empty($deptableau)){
            $allpays = Departements::whereIn("id",$deptableau)->pluck("country_id")->implode(",");
            $allpays = explode(",", $allpays);
           } else{
            $allpays = "";
            $allpays = explode(",", $allpays);
           }
           $paytableau = array_merge($allpays, $listpay);

           if(empty($listvil) && empty($listdep)){
            $paytableau = $listpay;
           }
           $depalltableau = Departements::where("country_id",$paytableau)->pluck("id")->implode(",");
           $depalltableau = explode("," , $depalltableau);
           $valeurs_users = [];
            foreach ($result as $element) {
                if (isset($element["users"])) {
                    $valeurs_users[] = $element["users"];
                }
            }
            $resultat = implode(",", $valeurs_users);
           $items1 = InfoInfluenceur::join('users', 'users.id', '=', 'info_influenceur.id_user')
            ->join('travailleur_centre_interet', 'travailleur_centre_interet.id_User', '=', 'info_influenceur.id_user')
            ->select('info_influenceur.*', 'users.nom','users.id as users','users.idprofil',
                'travailleur_centre_interet.id_Centre')
            ->where('users.idprofil' , 2)
            ->whereIn('id_Centre' , $listcentre)
            ->whereIn('id_departement' , $depalltableau)
            ->whereNotIn("info_influenceur.id_user",$valeurs_users)
            ->distinct()
            ->get();

        $totalinflu=0;
        foreach ($items1 as $iteminflu) {
            $userId = $iteminflu->id_User;
            // Vérifier si l'id_User existe déjà dans le tableau d'identifiants uniques
            if (!in_array($userId, $uniqueIds)) {

                $uniqueIds[] = $userId;
                $items2 = ([
                    "users" => $iteminflu->id_User,
                    "vue" => $iteminflu->nbr_vue_moyen

                ]);
                $uniqueItems1[] = $items2;
                $totalinflu += $iteminflu->nbr_vue_moyen;
            }
        }
        $vuesnew = $vue - $total;
        //$closestLowerDifference = PHP_INT_MAX; $selectedElement = null;
        foreach ($uniqueItems1 as $element) {
            $ecart = abs($element['vue'] - $vuesnew); // Calculer l'écart entre la valeur de l'élément et la valeur cible
            if ($ecart > 0 && $ecart < $closestLowerDifference) {
                $ecart_minimum = $ecart;
                $element_superieur = $element;
            }
        }
        $value = $element_superieur["users"];
        $value = explode(",",$value);
        $values = explode(",",$resultat);
        $influenceursuperieur = array_merge($value, $values);
        foreach ($influenceursuperieur as $userId) {
            DB::table('travailleur_tache')->insert([
                'idtravailleur'=>$userId,
                'idTache'=>$id,
                'idAdmin'=>Auth::user()->id
            ]);
        }
    }
        return redirect()->route("admin.tache");
    }

    public function distribuer(){
        $taches = Tache::has('travailleurs')
        ->with('travailleurs')
        ->get();

        $clients = $taches->map(function ($tache) {
        $travailleurs = $tache->travailleurs->map(function ($travailleur) {
            return [
                'nom' => $travailleur->nom,
                'prenom' => $travailleur->prenom,
            ];
        })->toArray();
        $infouser = User::where('id', $tache->idClient)->get(['nom', 'prenom'])->first();
        $libelle = TypeTache::where('id', $tache->typetache)->get('libelle')->first();
        return [
            'idTache' => $tache->id,
            'nomClient' => $infouser->nom,
            'prenomClient' => $infouser->prenom,
            'travailleurs' => $travailleurs,
            'debut' => $tache->dedut,
            'fin' => $tache->fin,
            'libelle' => $libelle->libelle
        ];
    })->toArray();

        return view("admin.attribuerTache", compact("clients"));
    }

    public function executez(){
        $taches = Tache::has('travailleurs')
        ->with('travailleurs')
        ->get();
        //dd($taches);
        //dd($taches[0]->travailleurs[0]->pivot->capture);
        $clients = $taches->map(function ($tache) {
            $travailleurs = $tache->travailleurs->filter(function ($travailleur) {
                return $travailleur->pivot->capture !== null && $travailleur->pivot->totalVues !== null;
            })->map(function ($travailleur) {
                return [
                    'nom' => $travailleur->nom,
                    'prenom' => $travailleur->prenom,
                    'capture' => $travailleur->pivot->capture,
                    'totalVues' => $travailleur->pivot->totalVues,
                ];
            })->toArray();
        $infouser = User::where('id', $tache->idClient)->get(['nom', 'prenom'])->first();
        $libelle = TypeTache::where('id', $tache->typetache)->get('libelle')->first();
        return [
            'idTache' => $tache->id,
            'nomClient' => $infouser->nom,
            'capture' => $infouser->capture,
            'totalVues' => $infouser->totalVues,
            'prenomClient' => $infouser->prenom,
            'travailleurs' => $travailleurs,
            'debut' => $tache->dedut,
            'fin' => $tache->fin,
            'libelle' => $libelle->libelle
        ];
    })->toArray();
        return view('admin.tacheexecute', compact('clients'));
    }

    public function preuve(){
        return view("admin.preuve");
    }
}
