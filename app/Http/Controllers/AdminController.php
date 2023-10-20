<?php

    namespace App\Http\Controllers;
    use App\Models\CentreInteret;
    use App\Models\Departements;
    use App\Models\InfoInfluenceur;
    use App\Models\TachePreuve;
    use App\Models\Pays;
    use App\Models\Tache;
    use App\Models\TravailleCentre;
    use App\Models\TravailleurTache;
    use App\Models\TypeTache;
    use App\Models\User;
    use App\Models\Villes;
    use App\Models\Admin;
    use App\Models\ViewPrice;
    use App\Models\Zone;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\DB;

    use GuzzleHttp\Client;
    use GuzzleHttp\Exception\GuzzleException;

use function Pest\Laravel\get;

class AdminController extends Controller
{
    public function index(){
        $centreInterets=CentreInteret::paginate(10);
        return view('admin.index', compact("centreInterets"));
    }

    public function tache(){
        $taches = Tache::has('travailleur')
            ->has('status')
            ->has('type')
            ->with('travailleur', 'status', 'type', 'centres')
            ->where('payement', 'paye')
            ->paginate(10);
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
                ->select('tache.realisation','tache.idStatus','type_tache.libelle as tache_libelle','users.nom','tache.debut','tache.fin','tache.fichier','tache.description',
                        'tache.typetache','tache.vueRecherche','status.libelle as status_libelle','tache.id as tacheid','users.prenom','users.id','users.idProfil',
                    DB::raw('GROUP_CONCAT(DISTINCT centre_interet.libelle) as centre'),
                    DB::raw('GROUP_CONCAT(DISTINCT pays.name) as pays'),
                    DB::raw('GROUP_CONCAT(DISTINCT departements.name) as departements'),
                    DB::raw('GROUP_CONCAT(DISTINCT villes.name) as villes'))
                ->groupBy('tache.realisation','users.nom','tache.debut','tache.fin','tache.fichier','tache.description',
                'tache.typetache','tache_libelle','tache.idStatus','tache.vueRecherche','status_libelle','tacheid','users.prenom','users.id','users.idProfil')
                ->where('users.idProfil',3)
                ->where('tache.idStatus',2)
                ->where('payement',"paye")
                ->get();
        return view('admin.tachevalide', compact("taches"));
    }

    public function centreStore(Request $request){
        CentreInteret::create([
            "libelle"=>$request->libelle,
        ]);
        return redirect()->route("admin.index");
    }

    public function edit(Request $request){
        DB::table('centre_interet')->where('id', $request->id)->update(['libelle' => $request->libelle]);
        return redirect()->back()->with('info', 'Votre modification est prise en compte');
    }

    public function tacheAttribut(Request $request,$id,$vues,
        $centre,$pay,$dep,$vil){
        $date = Tache::where('id', $id)->first();
        $date1 = strtotime($date->debut);
        $date2 = strtotime($date->fin);
        $nombre_de_secondes = $date2 - $date1;
        $nombre_de_jours = intval(ceil($nombre_de_secondes / (60 * 60 * 24)));
        $vues = intval($vues)/$nombre_de_jours;
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
        //dd($items);
        if(!blank($items)){
            DB::table('tache')->where('id', $id)->update(['idStatus' => 2]);
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
            }
            $result = $uniqueItems;
            $totalvues=0;
            $vue = $vues;
            //dd($vue, 45);
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
            $depalltableau = Departements::whereIn("country_id",$paytableau)->pluck("id")->implode(",");
            $depalltableau = explode("," , $depalltableau);
            $valeurs_users = [];
                foreach ($result as $element) {
                    if (isset($element["users"])) {
                        $valeurs_users[] = $element["users"];
                    }
                }
                //dd($depalltableau);
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
                $vuesnew = $vue - $total;
                //dd($vue, $total,$vuesnew);
                $resultArray = [];

                foreach ($items1 as $iteminflu) {
                $userId = $iteminflu->id_User;
                $vue = $iteminflu->nbr_vue_moyen;

                if (!isset($resultArray[$userId])) {
                    $resultArray[$userId] = [
                        'id_User' => $userId,
                        'nbr_vue_moyen' => $vue
                    ];
                }
            }

            // Réindexer le tableau pour obtenir des clés numériques
            $resultArray = array_values($resultArray);
            foreach ($resultArray as $element) {
                if (isset($element["users"])) {
                    $uniqueIds[] = $element["users"];
                }
            }
            $uniqueUsersnew = array_unique(array_column($resultArray, 'id_User'));
            $uniqueUsersnews = array_values($uniqueUsersnew);

            //$closestLowerDifference = PHP_INT_MAX; $selectedElement = null;
            foreach ($uniqueItems as $element) {
                $ecart = abs($element['vue'] - $vuesnew); // Calculer l'écart entre la valeur de l'élément et la valeur cible
                if ($ecart > 0 && $ecart < $closestLowerDifference) {
                    $ecart_minimum = $ecart;
                    $element_superieur = $element;
                }
            }
            //dd($vuesnew,$element_superieur);
            $value = $element_superieur["users"];
            $value = explode(",",$value);
            $values = explode(",",$resultat);
            $influenceursuperieur = array_diff($values, $value);
            //dd($values, $value,$influenceursuperieur);
            $filteredData = [];
            $totaux = 0;
            foreach ($uniqueItems as $itemNew) {

                if (in_array($itemNew["users"], $influenceursuperieur)) {
                    $filteredData[] = $itemNew;
                    $totaux += $itemNew["vue"];
                }
            }
            if($vuesnew >= $totaux){
                $userValues = [];
                foreach ($filteredData as $item) {
                    $userValues[] = $item["users"];
                }
                //dd($vuesnew , $totaux,$uniqueUsersnews,$value,$values,5);
                foreach ($uniqueUsersnews  as $userId) {
                    DB::table('travailleur_tache')->insert([
                        'idtravailleur'=>$userId,
                        'idTache'=>$id,
                        'idAdmin'=>Auth::user()->id
                    ]);
                }

                foreach ($value  as $userId) {
                    DB::table('travailleur_tache')->insert([
                        'idtravailleur'=>$userId,
                        'idTache'=>$id,
                        'idAdmin'=>Auth::user()->id
                    ]);
                }

            }else{
                $closestValue = null;
                $closestUsers = null;
                foreach ($filteredData as $item) {
                    $currentValue = $item["vue"];
                    if ($closestValue === null || abs($currentValue - $vuesnew) < abs($closestValue - $vuesnew)) {
                        $closestValue = $currentValue;
                        $closestUsers = $item["users"];
                    }
                }

                $numberArray = array($closestUsers);
                //dd($vuesnew , $totaux,$numberArray,$values,$value,6);
                foreach ($numberArray  as $userId) {
                    DB::table('travailleur_tache')->insert([
                        'idtravailleur'=>$userId,
                        'idTache'=>$id,
                        'idAdmin'=>Auth::user()->id
                    ]);
                }

                foreach ($value  as $userId) {
                    DB::table('travailleur_tache')->insert([
                        'idtravailleur'=>$userId,
                        'idTache'=>$id,
                        'idAdmin'=>Auth::user()->id
                    ]);
                }
            }
            }
            Admin::sendtachewhatsap($id);
            return back()->with('info', 'La tâche a été distribiée');
        } else{
            return redirect()->route("admin.tache")->with("info","Il y a pas d'influenceur dans ce de pays");
        }

    }

    public function distribuer(){
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
                ->select('tache.realisation','tache.idStatus','type_tache.libelle as tache_libelle','users.nom','tache.debut','tache.fin','tache.fichier','tache.description',
                        'tache.typetache','tache.vueRecherche','status.libelle as status_libelle','tache.id as tacheid','users.prenom','users.id','users.idProfil',
                    DB::raw('GROUP_CONCAT(DISTINCT centre_interet.libelle) as centre'),
                    DB::raw('GROUP_CONCAT(DISTINCT pays.name) as pays'),
                    DB::raw('GROUP_CONCAT(DISTINCT departements.name) as departements'),
                    DB::raw('GROUP_CONCAT(DISTINCT villes.name) as villes'))
                ->groupBy('tache.realisation','users.nom','tache.debut','tache.fin','tache.fichier','tache.description',
                'tache.typetache','tache_libelle','tache.idStatus','tache.vueRecherche','status_libelle','tacheid','users.prenom','users.id','users.idProfil')
                ->where('users.idProfil',3)
                ->where('tache.idStatus',1)
                ->where('payement',"paye")
                ->get();
        /* $taches = Tache::has('travailleurs')
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
       })->toArray(); */
        return view("admin.attribuerTache", compact("taches"));
    }

    public function executez(){
        $taches = Tache::has('travailleurtaches')
        ->with('travailleurtaches')
        ->with('type')
        ->with('travailleur')
        ->get();
        //dd($taches);
        //dd($taches[0]->travailleurs[0]->pivot->capture);
        $clientes = $taches->map(function ($tache) {
            $travailleurs = $tache->travailleurtaches->groupBy('id')->map(function ($travailleursGroup) {
                $totalVues = 0;
                $travailleursGroup->each(function ($travailleur) use (&$totalVues) {
                    $totalVues += $travailleur->pivot->totalVues;
                });
                $travailleur = $travailleursGroup->first();
                return [
                    'nom' => $travailleur->nom,
                    'prenom' => $travailleur->prenom,
                    'capture' => $travailleur->pivot->capture,
                    'totalVues' => $totalVues
                ];
            })->toArray();

            return [
                'idTache' => $tache->id,
                'debut' => $tache->debut,
                'fin' => $tache->fin,
                'libelle' => $tache->type->libelle,
                'clientnom' => $tache->travailleur->nom,
                'clientprenom' => $tache->travailleur->prenom,
                'travailleurs' => $travailleurs,
            ];
        });
        //dd($clientes);
        return view('admin.tacheexecute', compact('clientes'));
    }

    public function showPreuve($id, $idinfluenceur){
        $user = User::where('id', $idinfluenceur)->get();
        $preuves = TachePreuve::where("idtravailleur",$idinfluenceur)
        ->where("idTache", $id)
        ->get();
        $totalVues = $preuves->sum('totalVues');
        return view("admin.showpreuves", compact("preuves","totalVues","user","id"));
    }

    public function statistique(){
        $tachevalide = Tache::where('idStatus', 2)->where('payement','paye')->get();
        $tachenonvalide = Tache::where('idStatus', 1)->where('payement','paye')->get();
        $tacheall = Tache::where('payement','paye')->get();
        $tachevueatteint = Tache::where('realisation', 'Vues Atteint')->where('payement','paye')->get();
        $tachevuenonatteint = Tache::where('realisation', 'Vues Non Atteint')->where('payement','paye')->get();
        $tachenonexecute = Tache::where('realisation', 'Non Exécutée')->where('payement','paye')
        ->where ('idStatus', 2) ->get();
        $client = User::where('idProfil', 3)->get();
        $influenceur = User::where('idProfil', 2)->get();
        return view("statistique.statistique", compact('client','influenceur','tachevalide','tachevueatteint',
                                                'tacheall','tachenonvalide',
                                                'tachevuenonatteint','tachenonexecute'));
    }

    public function tableaudebord($id){
        $taches = Tache::with('travailleur')->where('realisation', $id)
        ->where ('idStatus', 2)->get();
        return view("statistique.show", compact('taches','id'));
    }

    public function viewprice(){
        $prices = ViewPrice::first();
        return view('admin.parametre', compact('prices'));
    }

    public function updateprice(Request $request){
        $info = ([
            'prixtache' => $request->prixtache,
            'prixinfluenceur' => $request->prixinfluenceur
        ]);
        ViewPrice::where("id", 1)->update($info);
        return back();
    }
}
