<?php

namespace App\Http\Controllers;

use App\Models\CentreInteret;
use App\Models\Departements;
use App\Models\Paiement;
use App\Models\InfoInfluenceur;
use App\Models\Pays;
use App\Models\Tache;
use App\Models\TravailleCentre;
use App\Models\TypeTache;
use App\Models\Villes;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\OrderShipped;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use StephaneAss\Payplus\Pay\PayPlus;

class ClientController extends Controller
{
    public function sendMail()
    {
        Mail::to('john.doe@gmail.com')->send(new OrderShipped());
    }


    public function direction(Request $request)
        {
            $co = (new PayPlus())->init();
            $response_code=$_POST['response_code'];
            $data = $co->getCustomData('email');
            $token=$_POST['token'];
            $success = auth()->attempt([
                'email' => "doumefiobignonanne@gmail.com",
                'password' => 'Anne 1234'
            ], request()->has('remember'));

            if($response_code==00){
                $data = $co->getCustomData('first_key');

            }
    }

    public function create(){
        $fichiers=TypeTache::all();
        $centres=CentreInteret::all();
        $pays=Pays::all();
        $departement=Departements::all();
        $villes=Villes::all();
        return view('client.create',compact('centres','fichiers','pays',
                     'departement','villes'));
     }

    public function redirige(){
        $fichiers=TypeTache::all();
        $centres=CentreInteret::all();
        $pays=Pays::all();
        return view('client.create',compact('fichiers','centres','pays'));
     }

    public function tacheenregistrer(){
        $user = Auth::user()->id;
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
            ->where('users.id',$user)
            ->where('payement',"paye")
            ->get();
        return view('client.index', compact('taches'));
    }

    public function store(Request $request){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $img = substr($request->url, 9);
        $tache = Tache::createTache($request, $user_id, $img);
        $idtache = $tache->id;
        $allPays = $request->pays;
        $allDeps = $request->departements;
        $allVilles = $request->villes;
        if(!empty($allVilles)){
            //les villes
            $villelist = implode(',', $allVilles);

            //les departement
            $depToDelete = Villes::whereIn('id', $allVilles)->pluck('state_id')->toArray();
            $depToSave = array_diff($allDeps, $depToDelete);
            $departementlist= implode(',', $depToSave);

            //les pays
            $paysToDelete = Departements::whereIn('id', $allDeps)->pluck('country_id')->toArray();
            $payToSave = array_diff($allPays, $paysToDelete);
            $payslist = implode(",", $payToSave);
            //dd($villelist,$departementlist,$payslist);

        } elseif(!empty($allDeps)  && empty($allVilles)){
            //les villes
            $villelist = "";

            //les departements
            $departementlist= implode(',', $allDeps);

            //les pays
            $deletpay = Departements::whereIn('id', $allDeps)->pluck('country_id')->toArray();
            $resultallPays = array_diff($allPays, $deletpay);
            $payslist = implode(",", $resultallPays);
            //dd($villelist, $departementlist, $payslist);
        } elseif(!empty($allPays)  && empty($allDeps) && empty($allVilles)){
            //les villes
            $villelist = "";

            //les departements
            $departementlist = "";

            //les pays
            $payslist = implode(",", $allPays);
            //dd($villelist, $departementlist, $payslist);
        }
        dd($villelist, $departementlist, $payslist);
        $centres=[];
        foreach ($request->centre as $value) {
            $centres[] = [
                'idTache' => $idtache,
                'idCentre' => $value,
            ];
        }
        DB::table('tache_centre')->insert($centres);
        //enregistrement de tache
        $datapay = [];
        $datadep = [];
        $datavil = [];
        $pay = !blank($payslist) ? explode("," , $payslist) : null;
        $arraydep = !blank($departementlist) ? explode("," ,$departementlist) : null;
        $arrayvil = !blank($villelist) ? explode("," ,$villelist) : null;

        if(!empty($pay)){
            foreach ($pay as $value) {
                $datapay[] = [
                    'idTache' => $idtache,
                    'idPay' => $value,
                ];
            }
            DB::table('tache_zone')->insert($datapay);
        }

        if(!empty($arraydep)){
            foreach ($arraydep as $value) {
                $datadep[] = [
                    'idTache' => $idtache,
                    'idDepartement' => $value,
                ];
            }
            DB::table('tache_zone')->insert($datadep);
        }

        if(!blank($arrayvil)){
            foreach ($arrayvil as $value) {
                $datavil[] = [
                    'idTache' => $idtache,
                    'idVille' => $value,
                ];
            }
            DB::table('tache_zone')->insert($datavil);
        }

        Paiement::create([
            'idUer' => $user_id,
            'idTache' => $idtache,
            'montant' => 1000
        ]);

        $co = (new PayPlus())->init();
                    $co->addItem("$user_email", 3, 150, 450, "Je suis un client");

                    $total_amount=$request->vueRecherche*2; // for test
                    $co->setTotalAmount($total_amount);
                    $co->setDescription("Achat de deux articles sur le site Jeans Missebo");
                    $mail=$user_email;
                    $password=$request->password;
                    $co->addCustomData('email', $mail);
                    $co->addCustomData('task_id', $idtache);
                    $co->addCustomData('user_id', $user_id);

                    // démarrage du processus de paiement
                    // envoi de la requete
                    if($co->create()) {
                        Auth::logout();
                        // Requête acceptée, alors on redirige le client vers la page de validation de paiement
                        return redirect()->to($co->getInvoiceUrl());
                    }else{
                        // Requête refusée, alors on affiche le motif du rejet
                        return [
                            "succes" => false,
                            "message" => "$co->response_text"
                        ];
                    }
    }

    public function clienttache($id){
        $tache = DB::table('tache')
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
                ->where('tache.id',$id)
                ->get();
        return view("admin.showtache", compact("tache"));
    }

    public function clienttacheencours(){
        $currentDate = Carbon::now()->toDateString();
        $taches = Tache::has('travailleurs')
        ->with('travailleurs')
        ->get();
        $clients = $taches->where('idClient',Auth::user()->id)
        ->where('debut', '<=', $currentDate)
        ->where('fin', '>=', $currentDate)
        ->map(function ($tache) {
        $travailleurs = $tache->travailleurs->map(function ($travailleur) {
            return [
                'nom' => $travailleur->nom,
                'prenom' => $travailleur->prenom,
            ];
        })->toArray();
        $infouser = User::where('id', $tache->idClient)
        ->get(['nom', 'prenom'])->first();
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
        return view("client.encours", compact('clients'));
    }

    public function clienttacheexecutez(){
        $taches = Tache::has('travailleurtaches')
        ->with('travailleurtaches')
        ->with('type')
        ->with('travailleur')
        ->get();
        //dd($taches);
        //dd($taches[0]->travailleurs[0]->pivot->capture);
        $clientes = $taches->where('idClient',Auth::user()->id)->map(function ($tache) {
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
        return view("client.executez", compact('clientes'));
    }
}
