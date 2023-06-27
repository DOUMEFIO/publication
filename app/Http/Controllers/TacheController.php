<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use App\Models\TypeTache;
use App\Models\Paiement;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\CentreInteret;
use App\Models\Departements;
use App\Models\Pays;
use App\Models\User;
use App\Models\Villes;
use Illuminate\Http\RedirectResponse;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Services\PublicStorage;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use StephaneAss\Payplus\Pay\PayPlus;

class TacheController extends Controller
{
    public function create(){
        $fichiers=TypeTache::all();
        $centres=CentreInteret::all();
        $pays=Pays::all();
        $departements=Departements::all();
        $villes=Villes::all();
       return view('tache.create', compact('fichiers','centres','pays','departements','villes'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        ]);
        $password = $request->input('password');
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
        return redirect()->back()->with('error', 'Le mot de passe doit comporter au moins une majuscule, une minuscule, un chiffre et un caractère spécial et doit être d\'au moins 8 caractères.');
        }else{
            $user = User::create([
                'nom' => $request->name,
                'prenom' => $request->prenom,
                'idProfil'=>3,
                'email'=>$request->email,
                'password' => Hash::make($request->password),
            ]);
            event(new Registered($user));
            //RegistrationLinkController::send($user->email);

            //user
            //Auth::login($user);
            //return redirect(RouteServiceProvider::HOME);

            $id = DB::select("
                SELECT * From users
                WHERE users.email='$request->email'");

            if ($request->typetache==1) {
                $tache=Tache::create([
                    'idClient'=> $id[0]->id,
                    'vueRecherche'=> $request->vueRecherche,
                    'debut'=> $request->debut,
                    'fin'=> $request->fin,
                    'fichier'=> " ",
                    'description'=> $request->description,
                    'typetache'=> $request->typetache,
                    'idStatus'=>1,
                    'total'=> $request->vueRecherche * 2
                ]);
                $tache->save();
                $idtache = $tache->id;
                $pay=$request->pays;
                $arraydep=$request->departements;
                $dep = explode(",", $arraydep);
                $arraycentre=$request->centre;
                $centre = explode(",", $arraycentre);
                //enregistrement de centre
                $centres=[];

                foreach ($centre as $value) {
                    $centres[] = [
                        'idTache' => $idtache,
                        'idCentre' => $value,
                    ];
                }
                DB::table('tache_centre')->insert($centres);
                //enregistrement de tache
                $data = [];
                if($pay == "pay"){
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $idtache,
                            'idPay' => $value,
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif ($pay == "dep") {
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $idtache,
                            'idDepartement' => $value
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif ($pay == "vil") {
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $idtache,
                            'idVille' => $value
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                }

                Paiement::create([
                    'idUer'=>$id[0]->id,
                    'idTache'=>$idtache
                ]);

                $co = (new PayPlus())->init();
                $co->addItem("$request->email", 3, 150, 450, "Je suis un client");

                $total_amount=$request->vueRecherche*2; // for test
                $co->setTotalAmount($total_amount);
                $co->setDescription("Achat de deux articles sur le site Jeans Missebo");
                $mail=$request->email;
                $password=$request->password;
                $co->addCustomData('email', $mail);
                $co->addCustomData('password', $password);
                //dd($co);

                // démarrage du processus de paiement
                // envoi de la requete
                if($co->create()) {

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
            elseif ($request->typetache==2) {
                $tache=Tache::create([
                    'idClient'=> $id[0]->id,
                    'vueRecherche'=> $request->vueRecherche,
                    'debut'=> $request->debut,
                    'fichier'=> $request->url,
                    'fin'=> $request->fin,
                    'description'=> " ",
                    'typetache'=> $request->typetache,
                    'idStatus'=>1
                ]);
                $tache->save();
                $id = $tache->id;
                $pay=$request->pays;
                $arraydep=$request->departements;
                $dep = explode(",", $arraydep);
                $arraycentre=$request->centre;
                $centre = explode(",", $arraycentre);
                //enregistrement de centre
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
                if($pay == "pay"){
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idPay' => $value,
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif ($pay == "dep") {
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idDepartement' => $value
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif ($pay == "vil") {
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idVille' => $value
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                }
                return redirect(RouteServiceProvider::HOME);
            }

            elseif ($request->typetache==3 || $request->typetache==4) {
                $tache= Tache::create([
                    'idClient'=> $id[0]->id,
                    'vueRecherche'=> $request->vueRecherche,
                    'debut'=> $request->debut,
                    'fin'=> $request->fin,
                    'fichier'=>$request->url,
                    'description'=> $request->description,
                    'typetache'=> $request->typetache,
                    'idStatus'=>1
                ]);

                $tache->save();
                $id = $tache->id;
                $pay=$request->pays;
                $arraydep=$request->departements;
                $dep = explode(",", $arraydep);
                $arraycentre=$request->centre;
                $centre = explode(",", $arraycentre);
                //enregistrement de centre
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
                if($pay == "pay"){
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idPay' => $value,
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif ($pay == "dep") {
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idDepartement' => $value
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif ($pay == "vil") {
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idVille' => $value
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                }
                return redirect(RouteServiceProvider::HOME);
            }
        }

    }

    public function verify($token=null, LoginRequest $req){
    $token = blank($token) ? $_GET['token'] : trim($token);

    $co = (new PayPlus())->init();
    $success = auth()->attempt([
        'email' => "doumefiobignonanne@gmail.com",
        'password' => 'Anne 1234'
    ], request()->has('remember'));

    if ($success) {
        return redirect()->to(RouteServiceProvider::HOME);
    }else {
        // Transaction has failed
        // Perform your failed logique here

    }
}

    public function login(Request $request, LoginRequest $req): RedirectResponse
    {
        $req->authenticate();

        $req->session()->regenerate();

        $id = DB::select("
            SELECT * From users
            WHERE users.email='$request->email'");

        if ($request->typetache==1) {
            $tache=Tache::create([
                'idClient'=> $id[0]->id,
                'vueRecherche'=> $request->vueRecherche,
                'debut'=> $request->debut,
                'fin'=> $request->fin,
                'fichier'=> " ",
                'description'=> $request->description,
                'typetache'=> $request->typetache,
                'idStatus'=>1
            ]);
            $tache->save();
                $id = $tache->id;
                $pay=$request->pays;
                $arraydep=$request->departements;
                $dep = explode(",", $arraydep);
                $arraycentre=$request->centre;
                $centre = explode(",", $arraycentre);
                //enregistrement de centre
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
                if($pay == "pay"){
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idPay' => $value,
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif ($pay == "dep") {
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idDepartement' => $value
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif ($pay == "vil") {
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idVille' => $value
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                }
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        elseif ($request->typetache==2) {
            $tache=Tache::create([
                'idClient'=> $id[0]->id,
                'vueRecherche'=> $request->vueRecherche,
                'debut'=> $request->debut,
                'fichier'=> $request->url,
                'fin'=> $request->fin,
                'description'=> " ",
                'typetache'=> $request->typetache,
                'idStatus'=>1
            ]);
            $tache->save();
                $id = $tache->id;
                $pay=$request->pays;
                $arraydep=$request->departements;
                $dep = explode(",", $arraydep);
                $arraycentre=$request->centre;
                $centre = explode(",", $arraycentre);
                //enregistrement de centre
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
                if($pay == "pay"){
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idPay' => $value,
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif ($pay == "dep") {
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idDepartement' => $value
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif ($pay == "vil") {
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idVille' => $value
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                }
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        elseif ($request->typetache==3 || $request->typetache==4) {
           $tache= Tache::create([
                'idClient'=> $id[0]->id,
                'vueRecherche'=> $request->vueRecherche,
                'debut'=> $request->debut,
                'fin'=> $request->fin,
                'fichier'=>$request->url,
                'description'=> $request->description,
                'typetache'=> $request->typetache,
                'idStatus'=>1
            ]);
            $tache->save();
                $id = $tache->id;
                $pay=$request->pays;
                $arraydep=$request->departements;
                $dep = explode(",", $arraydep);
                $arraycentre=$request->centre;
                $centre = explode(",", $arraycentre);
                //enregistrement de centre
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
                if($pay == "pay"){
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idPay' => $value,
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif ($pay == "dep") {
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idDepartement' => $value
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                } elseif ($pay == "vil") {
                    foreach ($dep as $value) {
                        $data[] = [
                            'idTache' => $id,
                            'idVille' => $value
                        ];
                    }
                    DB::table('tache_zone')->insert($data);
                }
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

}
