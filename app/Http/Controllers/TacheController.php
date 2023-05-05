<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use App\Models\TypeTache;
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

            //user
            Auth::login($user);
            $id = DB::select("
                SELECT * From users
                WHERE users.email='$request->email'");

            if ($request->typetache==1) {
                $tache = Tache::create([
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

                return redirect(RouteServiceProvider::HOME);
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
