<?php

namespace App\Http\Controllers;

use App\Models\CentreInteret;
use App\Models\Departements;
use App\Models\InfoInfluenceur;
use App\Models\Pays;
use App\Models\TravailleCentre;
use App\Models\TypeTache;
use App\Models\User;
use App\Models\Villes;
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
                ->select('users.id','users.idProfil' ,'users.nom', 'users.prenom', 'info_influenceur.tel', 'pays.name as pays', 'departements.name as departement',
                 'villes.name as ville','info_influenceur.nbr_vue_moyen', DB::raw('GROUP_CONCAT(centre_interet.libelle SEPARATOR \', \') as interests'))
                ->groupBy('users.id','info_influenceur.nbr_vue_moyen','users.idProfil' ,'users.nom', 'users.prenom', 'info_influenceur.tel', 'pays', 'departement', 'ville')
                ->where('users.idProfil',2)
                ->get();
        return view('influenceur.show', compact('users','alls'));
    }
    public function index()
    {
        $users = InfoInfluenceur::where('id_User', Auth::user()->id)->get();
        $centreInteret = DB::table('travailleur_centre_interet')
            ->leftJoin('users', 'users.id', '=', 'travailleur_centre_interet.id_User')
            ->select(DB::raw('GROUP_CONCAT(id_Centre) as ids'))
            ->where('id_user', '=', Auth::user()->id)
            ->groupBy('id_user')
            ->get();
        $string = $centreInteret[0]->ids;
        $array = explode(",", $string);
        $result = array();
        foreach ($array as $key => $value) {
            $result[$key] = $value ?: 0;
        }
        $libelles = CentreInteret::whereIn('id', $result)->pluck('libelle');
        $libelles = implode(",", $libelles->all());
        return view('influenceur.index', compact("users", "centreInteret", "libelles"));
    }

    public function create()
    {
        $centres = CentreInteret::all();
        $pays = Pays::all();
        $departements = Departements::all();
        $villes = Villes::all();
        return view('influenceur.create', compact('centres', 'pays', 'departements', 'villes'));
    }

    public function store(Request $request)
    {
        $user = Auth::user()->id;
        InfoInfluenceur::create([
            'id_User' => $user,
            'tel' => $request->tel,
            'nbr_vue_moyen' => $request->nbr_vue_moyen,
            'sexe' => $request->sexe,
            'id_pay' => $request->pay,
            'id_departement' => $request->departement,
            'id_ville' => $request->ville
        ]);
        foreach ($request->input('id_centre') as $centreId) {
            $toto = CentreInteret::find($centreId);
            $tata = new TravailleCentre();
            $tata->id_User = $user;
            $tata->id_centre = $toto->id;
            $tata->save();
        }
        return redirect()->route('index.influenceur');
    }

    public function getStates()
    {
        $country_id = request("country");
        $departements = Departements::where("country_id", $country_id)->get();
        $option = "<option value=''>Selectionner</option>";
        foreach ($departements as $departement) {
            $option .= '<option value=" ' . $departement->id . ' ">' . $departement->name . '</option>';
        }
        return $option;
    }

    public function getCities()
    {
        $satates_id = request("states");
        $villes = Villes::where("state_id", $satates_id)->get();
        $option = "<option value=''>Selectionner</option>";
        foreach ($villes as $ville) {
            $option .= '<option value=" ' . $ville->id . ' ">' . $ville->name . '</option>';
        }
        return $option;
    }

    public function getListeStates()
    {
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

    public function getListeCity()
    {
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

    public function totalvues()
    {
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
}
