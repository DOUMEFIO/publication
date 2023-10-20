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
use App\Models\TacheCentre;
use App\Models\User;
use App\Models\ViewPrice;
use App\Models\Zone;
use Illuminate\Support\Facades\Mail;
use StephaneAss\Payplus\Pay\PayPlus;

class ClientController extends Controller
{
    public function sendMail(){
        Mail::to('john.doe@gmail.com')->send(new OrderShipped());
    }

    public function direction(Request $request){
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
        $currentDate = now()->toDateString();
        $pays=Pays::all();
        $centres = CentreInteret::all();
        $fichiers = TypeTache::all();
        $taches = Tache::has('travailleur')
            ->has('status')
            ->has('type')
            ->with('travailleur','status','type','centres')
            ->where('idClient',Auth::user()->id)
            ->where('payement',"paye")
            ->paginate(10);
        return view('client.index', compact('pays','taches','currentDate','fichiers','centres'));
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
        //dd($villelist, $departementlist, $payslist);
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

        $co = (new PayPlus())->init();
                    $co->addItem("$user_email", 3, 150, 450, "Je suis un client");
                    $pricetache = Tache::where('id',$idtache)->first('prixtachedefault');
                    $pricetache = $pricetache->prixtachedefault;
                    $total_amount=$request->vueRecherche*$pricetache; // for test
                    $co->setTotalAmount($total_amount);
                    $co->setDescription("Achat de deux articles sur le site Jeans Missebo");
                    $mail=$user_email;
                    $password=$request->password;
                    $co->addCustomData('email', $mail);
                    $co->addCustomData('task_id', $idtache);
                    $co->addCustomData('user_id', $user_id);
                    $co->addCustomData('montant', $total_amount);

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
            $infouser = User::where('id', $tache->idClient)->get(['nom', 'prenom','idProfil','email'])->first();
            return [
                "idClient" => $tache->idClient,
                "idTache" => $tache->id,
                "vueRecherche" => $tache->vueRecherche,
                "profil" => $infouser->idProfil,
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
        return view("admin.showtache", compact("pays","departements","villes","centre","clients",
                                                "idpays","iddepartements","idvilles","idcentre"));
    }

    public function clienttacheencours(){
        $currentDate = Carbon::now()->toDateString();
        $taches = Tache::has('travailleurs')
            ->with('travailleurs')
            ->get();
        $clientsall = $taches->where('idClient',Auth::user()->id)
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
                    'realisation' => $tache->realisation,
                    'status' => $tache->status,
                    'vues' => $tache->vueRecherche,
                    'debut' => $tache->debut,
                    'fin' => $tache->fin,
                    'libelle' => $libelle->libelle,
                    'nomClient' => $infouser->nom,
                    'prenomClient' => $infouser->prenom,
                    'travailleurs' => $travailleurs,
                ];
            })->toArray();
        $clients = [];
        $currentDate = now()->toDateString();
        foreach ($clientsall as $client) {
            if ($currentDate >= $client["debut"] && $currentDate <= $client["fin"]) {
                $clients[] = $client; // Ajouter la tâche au tableau si elle est en cours
            }
        }
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
                'realisation' => $tache->realisation,
                'status' => $tache->status,
                'libelle' => $tache->type->libelle,
                'clientnom' => $tache->travailleur->nom,
                'clientprenom' => $tache->travailleur->prenom,
                'travailleurs' => $travailleurs,
            ];
        });
        return view("client.executez", compact('clientes'));
    }

    public function show(){
        $users = User::where('idProfil',3)->paginate(10);
        return view("client.show", compact("users"));
    }

    public function clienttacheall($id){
        $taches = Tache::with("travailleur")->where('idClient',$id)->get();
        return view("client.tachesall", compact("taches"));
    }

    public function clientconnect(){
        $clients = Tache::with("travailleur")
        ->where('idClient', Auth::user()->id)
        ->get();
        return view("client.profil", compact("clients"));
    }

    public function edittache(Request $request){
        return redirect()->back()->with('info', 'Votre modification a été prise en compte');
    }
}
