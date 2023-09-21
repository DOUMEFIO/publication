<?php

namespace App\Http\Controllers;

use App\Models\CentreInteret;
use App\Models\Departements;
use App\Models\InfoInfluenceur;
use App\Models\Pays;
use App\Models\TravailleCentre;
use App\Models\TypeTache;
use App\Models\Tache;
use App\Models\TachePreuve;
use App\Models\TravailleurTache;
use App\Models\User;
use App\Models\TacheCentre;
use App\Models\Villes;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class InfluenceurController extends Controller
{
    public function show(){
        $alls=User::where('idProfil', 2)->get();
        $users = DB::table('users')
                ->leftJoin('info_influenceur', 'users.id', '=', 'info_influenceur.id_user')
                ->leftJoin('travailleur_centre_interet', 'users.id', '=', 'travailleur_centre_interet.id_User')
                ->leftJoin('centre_interet', 'travailleur_centre_interet.id_Centre', '=', 'centre_interet.id')
                ->leftJoin('pays', 'info_influenceur.id_pay', '=', 'pays.id')
                ->leftJoin('departements', 'info_influenceur.id_departement', '=', 'departements.id')
                ->leftJoin('villes', 'info_influenceur.id_ville', '=', 'villes.id')
                ->select('users.photpProfil','users.id','users.idProfil' ,'users.nom', 'users.prenom', 'info_influenceur.tel', 'pays.name as pays', 'departements.name as departement',
                 'villes.name as ville','info_influenceur.nbr_vue_moyen', DB::raw('GROUP_CONCAT(centre_interet.libelle SEPARATOR \', \') as interests'))
                ->groupBy('users.photpProfil','users.id','info_influenceur.nbr_vue_moyen','users.idProfil' ,'users.nom', 'users.prenom', 'info_influenceur.tel', 'pays', 'departement', 'ville')
                ->where('users.idProfil',2)
                ->get();
        return view('influenceur.show', compact('users','alls'));
    }

    public function influenceurconnect(Request $data){
        $profil=User::where('id', Auth::user()->id)->get('photpProfil');
        $users=InfoInfluenceur::where('id_User',Auth::user()->id)->get();
        $centres=CentreInteret::all();
        $pays=Pays::all();
        $influenceur = InfoInfluenceur::where('id_user', '=', Auth::user()->id)->get();
        if(!$influenceur->isEmpty()){
            $centreInteret = DB::table('travailleur_centre_interet')
                ->leftJoin('users', 'users.id', '=', 'travailleur_centre_interet.id_User')
                ->select(DB::raw('GROUP_CONCAT(id_Centre) as ids'))
                ->where('id_user', '=', Auth::user()->id)
                ->groupBy('id_user')
                ->get();
                    $string = $centreInteret[0]->ids;
                    $array = explode(",", $string);
                    $result = array();
            foreach($array as $key => $value) {
                $result[$key] = $value ?: 0;
            }
            $libelles = CentreInteret::whereIn('id', $result)->pluck('libelle');
            $idlibelles = CentreInteret::whereIn('id', $result)->pluck('id');

            return view('influenceur.index', compact("pays","users","centreInteret","idlibelles","libelles","centres","profil"));
        }else{
            $url = url("confirm/" . Auth::user()->id);
            return redirect($url);
        }
    }

    public function create(){
        $centres = CentreInteret::all();
        $pays = Pays::all();
        $departements = Departements::all();
        $villes = Villes::all();
        return view('influenceur.create', compact('centres', 'pays', 'departements', 'villes'));
    }

    public function store(Request $request){
        $tel = InfoInfluenceur::where('tel', $request->tel)->exists();
        if(!$tel){
            InfoInfluenceur::createInfoInfluenceur($request, Auth::user()->id);
            TravailleCentre::userCentre(Auth::user()->id, $request->input('id_centre'));
            return redirect()->route('influenceurconnect');
        } else{
            return redirect()->back()->with('tel', 'Votre numéro de téléphone existe déjà.')->withInput();
        }
    }

    public function getStates(){
        $country_id = request("country");
        $departements = Departements::where("country_id", $country_id)->get();
        $option = "<option value=''>Selectionner</option>";
        foreach ($departements as $departement) {
            $option .= '<option value=" ' . $departement->id . ' ">' . $departement->name . '</option>';
        }
        return $option;
    }

    public function getCities(){
        $satates_id = request("states");
        $villes = Villes::where("state_id", $satates_id)->get();
        $option = "<option value=''>Selectionner</option>";
        foreach ($villes as $ville) {
            $option .= '<option value=" ' . $ville->id . ' ">' . $ville->name . '</option>';
        }
        return $option;
    }

    public function getListeStates(){
        $country_id = explode('_', request("country"));
        $option = '<option value="">Selectionner</option>';
        $departments = DB::table('departements')
            ->whereIn('country_id', $country_id)
            ->get();
        foreach ($departments as $key=>$departement) {
            $option .= "<option value=' $departement->id '>$departement->name </option>";
        }
        return $option;
    }

    public function getListeCity(){
        $states_id = explode('_', request("state"));
        $option = '<option value="">Selectionner</option>';
        $villes = DB::table('villes')
            ->whereIn('state_id', $states_id)
            ->get();
        foreach ($villes as $key=>$ville) {
            $option .= "<option value=' $ville->id '>$ville->name </option>";
        }
        return $option;
    }

    public function totalvues(){
        $items = DB::table('info_influenceur')
                ->join('users', 'users.id', '=', 'info_influenceur.id_user')
                ->join('travailleur_centre_interet', 'travailleur_centre_interet.id_User', '=', 'info_influenceur.id_user')
                ->select('info_influenceur.*', 'users.nom',
                'travailleur_centre_interet.id_Centre')
                ->get();

                $totalvues='<p class="text-primary m-0 fw-bold" ><strong>Nous pouvons vous
                générer : vues </strong></p>';
                $satates_id = request("total");
                $tata='2,3,6___';
                $array = explode("_", $satates_id);
                foreach ($array as $key => $value) {
                    $sub_array = explode(",", $value);
                    if ($key % 4 == 0) {
                        $cal = $sub_array;
                    } elseif ($key % 4 == 1) {
                        $py = $sub_array;
                    } elseif ($key % 4 == 2) {
                        $dp = $sub_array;
                    } else {
                        $vl = $sub_array;
                    }
                }
                    $idCentreList = array_map('intval', $cal);
                    if (empty($py[0])) {
                        $pay = [];
                    } else {
                        $pay = array_filter(array_map('intval', $py));
                    }

                    if (empty($dp[0])) {
                        $dep = [];
                    } else {
                        $dep = array_filter(array_map('intval', $dp));
                    }

                    if (empty($vl[0])) {
                        $vil = [];
                    } else {
                        $vil = array_filter(array_map('intval', $vl));
                    }
                    $result = [];
                foreach ($items as $item) {
                if($idCentreList && !empty($pay) && !empty($dep) && !empty($vil)) {
                if (in_array($item->id_Centre, $idCentreList) && in_array($item->id_ville, $vil)) {
                    $result[] = [
                        'moi'=>'ville',
                        'nom'=>$item->nom,
                        'centre'=>$item->id_Centre,
                        'villes'=>$item->id_ville,
                        'vue'=>$item->nbr_vue_moyen
                    ];
                }
                } elseif($idCentreList && !empty($pay) && !empty($dep)) {
                if (in_array($item->id_Centre, $idCentreList) && in_array($item->id_departement, $dep)) {
                    $result[] = [
                        'moi'=>'dep',
                        'nom'=>$item->nom,
                        'centre'=>$item->id_Centre,
                        'departement'=>$item->id_departement,
                        'vue'=>$item->nbr_vue_moyen
                    ];
                }
                } elseif($idCentreList && !empty($pay)) {
                if (in_array($item->id_Centre, $idCentreList) && in_array($item->id_pay, $pay)) {
                    $result[] = [
                        'moi'=>'pay',
                        'nom'=>$item->nom,
                        'centre'=>$item->id_Centre,
                        'departement'=>$item->id_pay,
                        'vue'=>$item->nbr_vue_moyen
                    ];
                }
                } elseif($idCentreList){
                if (in_array($item->id_Centre, $idCentreList)) {
                    $result[] = [
                        'centre'=>$item->id_Centre,
                        'vue'=>$item->nbr_vue_moyen
                    ];
                }
                }
                }
                $total=0;

                foreach ($result as $item) {
                $total += $item['vue'];
                }
                $totalvues ='<p class="text-primary m-0 fw-bold" style="text-align:center" ><strong>Nous pouvons vous
                générer : '.$total.' vues </strong></p>';
        return $totalvues;
    }

    public function pictureUpdate(Request $request){
        $avatar = $request->file('avatar');
        $path = $avatar->store('public/fichiers');
        $img = substr($path, 6);
        DB::table('users')->where('id', Auth::user()->id)->update(['photpProfil' => $img]);
        return redirect()->back();
    }

    public function pictureUpdatee(Request $request){

        TravailleCentre::where("id_User", Auth::user()->id)->delete();

        InfoInfluenceur::updateInfluenceur($request, Auth::user()->id);

        User::updateUser($request, Auth::user()->id);

        if(!blank ($request->id_centre)){
            $anciensEnregistrements = array_slice($request->id_centre, 1);
            $anciensEnregistrements1 = json_decode($request->idlibelles);
            $nouveauxEnregistrements = array_merge(
                array_map('strval', $anciensEnregistrements1),
                $anciensEnregistrements
            );
            $nouveauxEnregistrements = array_unique($nouveauxEnregistrements);
            TravailleCentre::userCentre(Auth::user()->id, $nouveauxEnregistrements);
        }

        return redirect()->back();
    }

    public function influtachencour(){
        $currentDate = now()->toDateString();
        $tachesall = TravailleurTache::with('tacheall.type','tacheall.travailleur')
            ->where('idtravailleur', Auth::user()->id)
            ->get();
        $taches = [];

        foreach ($tachesall as $tache) {
            if ($currentDate >= $tache->tacheall->debut && $currentDate <= $tache->tacheall->fin) {
                $taches[] = $tache; // Ajouter la tâche au tableau si elle est en cours
            }
        }

        return view('influenceur.tacheattribuer', compact('taches','currentDate'));
    }

    public function vuesrealisee($id){
        return view('influenceur.update', compact('id'));
    }

    public function updatevues(Request $request){
        $avatar = $request->file('avatar');
        $path = $avatar->store('public/fichiers');
        $img = substr($path, 6);
        $periode = Tache::select('fin', 'debut')
               ->where('id', $request->id)
               ->first();
        $currentDate = now()->toDateString();
        if ($currentDate >= $periode->debut && $currentDate <= $periode->fin) {
            TachePreuve::create([
                'idtravailleur' => Auth::user()->id,
                'idTache' => $request->id,
                'totalVues' => $request->nbr_vue_moyen,
                'capture' => $img
            ]);
            $taches = TachePreuve::with("infotache")->get();
            $vues = Tache::where('id', $request->id)->first('vueRecherche');
            $realisation = TachePreuve::where('idTache', $request->id)->get('totalVues');
            $sommeTotalVues = $realisation->sum('totalVues');
            if($vues->vueRecherche <= $sommeTotalVues  ){
                DB::table('tache')->where('id', $request->id)->update(['realisation' => 'Vues Atteint']);
            }
            else{
                DB::table('tache')->where('id', $request->id)->update(['realisation' => 'Vues Non Atteint']);
            }
            return redirect()->back()->with('info','Vos preuves ont été soumises.');
        } else {
           return redirect()->back()->with('info','Vous n\'etes pas dans la période de la tâche.');
        }
    }

    public function tachedo(){
        $taches = Tache::has('travailleurtaches')
        ->with('travailleurtaches')
        ->with('type')
        ->with('travailleur')
        ->get();
        $clientes = $taches->map(function ($tache) {
            $travailleurs = $tache->travailleurtaches->where('id', Auth::user()->id)->groupBy('taches.id')->map(function ($travailleursGroup) {
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
      //dd( $travailleurs);
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
        return view('influenceur.tacheexecute', compact('clientes'));
    }

    public function infludistribuer($id){
        $taches = Tache::has('travailleurs')
        ->with('travailleurs')
        ->get();
        $clients = $taches->where('id', $id)->map(function ($tache) {
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
        dd($clients,$id);
        return view("admin.attribuerTache", compact("clients"));
    }

    public function clienttache($id){
        $user = Auth::user()->id;
        $centres = TacheCentre::where('idTache', $id)
        ->with('centre')
        ->get();

        $zones = Zone::where('idTache', $id)
        ->with('residencepay','residencedep','residencevil')
        ->get();

        $pays = $zones->pluck('residencepay.name')->implode(', ');
        $departements = $zones->pluck('residencedep.name')->implode(' ');
        $villes = $zones->pluck('residencevil.name')->implode(' ');
        $centre = $centres->pluck('centre.libelle')->implode(' ');

        $idpays = implode(',', array_filter(explode(',', $zones->pluck('idPay')->implode(','))));
        $iddepartements = implode(',', array_filter(explode(',', $zones->pluck('idDepartement')->implode(','))));
        $idvilles = implode(',', array_filter(explode(',', $zones->pluck('idVille')->implode(','))));
        $idcentre = implode(',', array_filter(explode(',', $centres->pluck('idCentre')->implode(','))));


        $taches = Tache::with('travailleurs','type','status','travailleurtaches')
        ->where('id', $id)
        ->get();
        $clients = $taches->map(function ($tache) {
            $totalVuesGlobal = 0;
            $travailleurstaches = $tache->travailleurtaches->groupBy('id')->map(function ($travailleursGroup) {
                $totalVues = 0;
                $travailleursGroup->each(function ($travailleur) use (&$totalVues) {
                    $totalVues += $travailleur->pivot->totalVues;
                });
                $travailleur = $travailleursGroup->first();
                return [
                    'id' => $travailleur->id,
                    'nom' => $travailleur->nom,
                    'prenom' => $travailleur->prenom,
                    'capture' => $travailleur->pivot->capture,
                    'totalVues' => $totalVues
                ];
            })->toArray();
            foreach ($travailleurstaches as $travailleur) {
                $totalVuesGlobal += $travailleur['totalVues'];
            }

            $travailleurs = $tache->travailleurs->map(function ($travailleur) {
                $infoinfluenceur = InfoInfluenceur::where("id_User", $travailleur->id)->get();
                return [
                    'id' => $travailleur->id,
                    'nom' => $travailleur->nom,
                    'prenom' => $travailleur->prenom,
                    'image'=>$travailleur->photpProfil,
                    'email'=>$travailleur->email,
                    'tel' => $infoinfluenceur[0]-> tel,
                    'vues' => $infoinfluenceur[0]-> nbr_vue_moyen,
                    'sexe' => $infoinfluenceur[0]-> sexe,
                ];
            })->toArray();
            $infouser = User::where('id', $tache->idClient)->get(['nom', 'prenom'])->first();
            return [
                "idTache" => $tache->id,
                "vueRecherche" => $tache->vueRecherche,
                "nomClient" => $infouser->nom,
                "mailClient" => $infouser->email,
                "fin" => $tache->fin,
                "debuts" => $tache->debut,
                "fichier" => $tache->fichier,
                "description" => $tache->description,
                'prenomClient' => $infouser->prenom,
                'libelle' => $tache->type->libelle,
                'status' => $tache->status->libelle,
                'totalvues' => $totalVuesGlobal,
                'totalinflu' => count($travailleurs),
                'travailleurs' => $travailleurs,
                'travailleurstaches' => $travailleurstaches,
            ];
        })->toArray();
        return view("influenceur.showtache", compact("user","pays","departements","villes","centre","clients",
                                                "idpays","iddepartements","idvilles","idcentre"));
    }

    public function influenceurtache($id){
        $influenceurs = InfoInfluenceur::with("type","residencepay","residencedep","residencevil")
        ->where("id_User", $id)->get();
        $centres = TravailleCentre::with("centre")->where("id_User", $id)->get();
        $taches = TravailleurTache::with("tacheall.status","tacheall.travailleur")->where("idtravailleur", $id)->get();
        return view('influenceur.showtacheclient', compact("influenceurs","centres","taches"));
    }

    public function whatsapcofirm($id){
        $code = str_pad(mt_rand(1, 9999), 4, '0', STR_PAD_LEFT);
        $url = "https://wa.me/22968455275?text=" . urlencode("$code");
        return redirect()->away($url);
    }
}
