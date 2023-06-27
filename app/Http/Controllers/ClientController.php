<?php

namespace App\Http\Controllers;

use App\Models\CentreInteret;
use App\Models\Departements;
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
            dd($response_code,$data);
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

    public function influenceurconnect(){
        $users=InfoInfluenceur::where('id_User',Auth::user()->id)->get();
        $centres=CentreInteret::all();
        $pays=Pays::all();
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
               #$libelles = implode(",", $libelles->all());
        return view('influenceur.index', compact("pays","users","centreInteret","libelles","centres"));
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
                ->get();
        return view('client.index', compact('taches'));
    }

    public function store(Request $request){
        $user = Auth::user()->id;
        if ($request->typetache==1) {
           $tache= Tache::create([
                'idClient'=> $user,
                'vueRecherche'=> $request->vueRecherche,
                'debut'=> $request->debut,
                'fin'=> $request->fin,
                'fichier'=>" ",
                'description'=> $request->description,
                'typetache'=>$request->typetache,
                'idStatus'=>1
            ]);
            $tache->save();
            $id = $tache->id;
            $pay=$request->pays;
            $dep= $request->departements;
            $vil= $request->villes;
            $centre = $request->centre;
            $centres=[];

                foreach ($centre as $value) {
                    $centres[] = [
                        'idTache' => $id,
                        'idCentre' => $value,
                    ];
                }
                DB::table('tache_centre')->insert($centres);
                //enregistrement de tache
                $data = [];
                if(isset($pay) && isset($dep) && isset($vil)) {
                    foreach ($vil as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idVille' => $value,
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif(isset($pay) && isset($dep)) {
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idDepartement' => $value,
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif(isset($pay)) {
                    foreach ($pay as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idPay' => $value,
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                }
            return redirect()->route('/dashboard');
        } elseif ($request->file('avatar') && $request->typetache != 1) {
                $fichier = $request->file('avatar');
                // Vérification de l'extension du fichier
                if ($request->typetache == '4' && !in_array($fichier->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                    return redirect()->back()->with('error', 'Le fichier doit être une image.');
                } elseif ($request->typetache == '3' && !in_array($fichier->getClientOriginalExtension(), ['mp4', 'mov', 'avi', 'wmv'])) {
                    return redirect()->back()->with('error', 'Le fichier doit être une vidéo.');
                } elseif ($request->typetache == '2' && !in_array($fichier->getClientOriginalExtension(), ['mp3','wav','aiff','wma','aac','flac','ogg','m4a'])) {
                    return redirect()->back()->with('error', 'Le fichier doit être une audio.');
                }
                $path = $fichier->store('public/fichiers');
                if($request->typetache != '2'){
                   $tache= Tache::create([
                        'idClient'=> $user,
                        'vueRecherche'=> $request->vueRecherche,
                        'debut'=> $request->debut,
                        'fin'=> $request->fin,
                        'fichier'=> $path,
                        'description'=> $request->description,
                        'typetache'=>$request->typetache,
                        'idStatus'=>1
                    ]);
                    $tache->save();
            $id = $tache->id;
            $pay=$request->pays;
            $dep= $request->departements;
            $vil= $request->villes;
            $centre = $request->centre;
            $centres=[];

                foreach ($centre as $value) {
                    $centres[] = [
                        'idTache' => $id,
                        'idCentre' => $value,
                    ];
                }
                DB::table('tache_centre')->insert($centres);
                //enregistrement de tache
                $data = [];
                if(isset($pay) && isset($dep) && isset($vil)) {
                    foreach ($vil as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idVille' => $value,
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif(isset($pay) && isset($dep)) {
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idDepartement' => $value,
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif(isset($pay)) {
                    foreach ($pay as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idPay' => $value,
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                }
                    return redirect()->route('/dashboard');
                }

                if($request->typetache == '2'){
                   $tache= Tache::create([
                        'idClient'=> $user,
                        'vueRecherche'=> $request->vueRecherche,
                        'debut'=> $request->debut,
                        'fin'=> $request->fin,
                        'fichier'=> $path,
                        'description'=> " ",
                        'typetache'=>$request->typetache,
                        'idStatus'=>1
                    ]);
                    dd($tache);
                    $tache->save();
            $id = $tache->id;
            $pay=$request->pays;
            $dep= $request->departements;
            $vil= $request->villes;
            $centre = $request->centre;
            $centres=[];

                foreach ($centre as $value) {
                    $centres[] = [
                        'idTache' => $id,
                        'idCentre' => $value,
                    ];
                }
                DB::table('tache_centre')->insert($centres);
                //enregistrement de tache
                $data = [];
                if(isset($pay) && isset($dep) && isset($vil)) {
                    foreach ($vil as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idVille' => $value,
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif(isset($pay) && isset($dep)) {
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idDepartement' => $value,
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif(isset($pay)) {
                    foreach ($pay as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idPay' => $value,
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                }
                    return redirect()->route('/dashboard');
                }
        }
    }
}
