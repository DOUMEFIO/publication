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
        }
        else{
            //$user = User::createUserClient($request);
            $user = User::create([
                'nom' => $request->name,
                'prenom' => $request->prenom,
                'idProfil'=>3,
                'email'=>$request->email,
                'password' => Hash::make($request->password),
            ]);
            event(new Registered($user));
            RegistrationLinkController::send($user->email);

            $id = User::where('email',$request->email)->get();

            $user_id = $id[0]->id;
            $img = substr($request->url, 9);
            $tache = Tache::createTache($request, $user_id, $img);
            $idtache = $tache->id;
            $pay = !blank($request->pays) ? explode("," , $request->pays) : null;
            $arraydep = !blank($request->departements) ? explode("," ,$request->departements) : null;
            $arrayvil = !blank($request->ville) ? explode("," ,$request->ville) : null;
            $arraycentre=$request->centre;
            $centre = explode(",", $arraycentre);
            $centres=[];
            foreach ($centre as $value) {
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

            return Paiement::paiement($request, $tache->id , $user_id);

        }
    }

    public function login(Request $request, LoginRequest $req): RedirectResponse{
        $id = User::where('email',$request->email)->get();
        if (!empty($id)) {
            $user = $id[0];
            if (Hash::check($request->password, $user->password)) {
                $user_id = $id[0]->id;
                $img = substr($request->url, 9);
                $tache = Tache::createTache($request, $user_id, $img);
                $idtache = $tache->id;
                $pay = !blank($request->pays) ? explode("," , $request->pays) : null;
                $arraydep = !blank($request->departements) ? explode("," ,$request->departements) : null;
                $arrayvil = !blank($request->ville) ? explode("," ,$request->ville) : null;
                $arraycentre=$request->centre;
                $centre = explode(",", $arraycentre);
                $centres=[];
                foreach ($centre as $value) {
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

                return Paiement::paiement($request, $tache->id , $user_id);
            }
            return redirect()->route('form.connection')->With('info',"L'utilisateur n'a pas été trouvé"); // Redirection vers une autre page par exemple
        }
    }

    public function verify(Request $request){
        $token=$request->token;
        $token = blank($token) ? $_GET['token'] : trim($token);
        //$transaction=Transaction::find($request->transaction_id);
        //dd($token);
        $co = (new PayPlus())->init();
        if ($co->confirm($token)) {
            $user_id = $co->getCustomData("user_id");
            $task_id = $co->getCustomData("task_id");
            if (!blank($user_id)) {
                $user = User::find($user_id);
                DB::table('tache')->where('id', $task_id)->update(['payement' => 'paye']);
                if (!blank($user)){
                    Auth::login($user);
                    return redirect()->to(RouteServiceProvider::HOME);
                }
            }
            else {
                // user_id not found
            }
        }
        else {
                // Transaction has failed
                // Perform your failed logique here
        }
    }
}
