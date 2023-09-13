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
use Illuminate\Support\Facades\Storage;
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

    public function getFormDatas(Request $request){
        $avatar = $request->session()->get('avatar');
        return [
            'centre' => $request->session()->get('centre'),
            'pay' => $request->session()->get('pays'),
            'dep' => $request->session()->get('departements'),
            'vil' => $request->session()->get('ville'),
            'vueRecherche' => $request->session()->get('vueRecherche'),
            'debut' => $request->session()->get('debut'),
            'fin' => $request->session()->get('fin'),
            'url' => Storage::url($avatar),
            'description' => $request->session()->get('description'),
            'fin' => $request->session()->get('fin'),
            'typetache' => $request->session()->get('typetache'),
        ];
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
            $users = User::where('email',$request->email)->get()->first();
            $datas = $this->getFormDatas($request);
            $img = substr($datas["url"], 9);
            $tache = Tache::createTache($datas, $users->id, $img);
            $pay = !blank($datas["pay"]) ? explode("," , $datas["pay"]) : null;
            $arraydep = !blank($datas["dep"]) ? explode("," ,$datas["dep"]) : null;
            $arrayvil = !blank($datas["vil"] ) ? explode("," ,$datas["vil"] ) : null;
            $arraycentre = $datas["centre"] ;
            $centre = explode(",", $arraycentre);
            $centres=[];
            foreach ($centre as $value) {
                $centres[] = [
                    'idTache' => $tache->id,
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
                        'idTache' => $tache->id,
                        'idPay' => $value,
                    ];
                }
                DB::table('tache_zone')->insert($datapay);
            }

            if(!empty($arraydep)){
                foreach ($arraydep as $value) {
                    $datadep[] = [
                        'idTache' => $tache->id,
                        'idDepartement' => $value,
                    ];
                }
                DB::table('tache_zone')->insert($datadep);
            }

            if(!blank($arrayvil)){
                foreach ($arrayvil as $value) {
                    $datavil[] = [
                        'idTache' => $tache->id,
                        'idVille' => $value,
                    ];
                }
                DB::table('tache_zone')->insert($datavil);
            }
           return Paiement::paiementdo($datas["vueRecherche"],$request, $tache->id , $user->id);
        }
    }

    public function login(Request $request, LoginRequest $req): RedirectResponse{
        $datas = $this->getFormDatas($request);
        $user = User::where('email',$request->email)->first();
        if (!blank($user) && Hash::check($request->password, $user->password)) {
            $img = substr($datas["url"], 9);
            $tache = Tache::createTache($datas, $user->id, $img);
            $pay = !blank($datas["pay"]) ? explode("," , $datas["pay"]) : null;
            $arraydep = !blank($datas["dep"]) ? explode("," ,$datas["dep"]) : null;
            $arrayvil = !blank($datas["vil"] ) ? explode("," ,$datas["vil"] ) : null;
            $arraycentre = $datas["centre"] ;
            $centre = explode(",", $arraycentre);
            $centres=[];
            foreach ($centre as $value) {
                $centres[] = [
                    'idTache' => $tache->id,
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
                        'idTache' => $tache->id,
                        'idPay' => $value,
                    ];
                }
                DB::table('tache_zone')->insert($datapay);
            }

            if(!empty($arraydep)){
                foreach ($arraydep as $value) {
                    $datadep[] = [
                        'idTache' => $tache->id,
                        'idDepartement' => $value,
                    ];
                }
                DB::table('tache_zone')->insert($datadep);
            }

            if(!blank($arrayvil)){
                foreach ($arrayvil as $value) {
                    $datavil[] = [
                        'idTache' => $tache->id,
                        'idVille' => $value,
                    ];
                }
                DB::table('tache_zone')->insert($datavil);
            }

            return Paiement::paiementdo($datas["vueRecherche"], $request, $tache->id , $user->id);
        } elseif(!blank($user) && !Hash::check($request->password, $user->password)){
            return redirect()->route('form.connection')->With('info',"Le mot de passe est incorrect"); // Redirection vers une autre page par exemple
        }
        return redirect()->route('form.connection')->With('info',"L'utilisateur n'a pas été trouvé"); // Redirection vers une autre page par exemple
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
            $total_amount = $co->getCustomData("montant");
            Paiement::create([
                'idUer' => $user_id,
                'idTache' =>$task_id,
                'montant' => $total_amount,
                'token'   => $token,
            ]);
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
