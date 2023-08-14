<?php

namespace App\Http\Controllers;

use App\Models\Departements;
use App\Models\Villes;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class ActionController extends Controller
{
    public function index(Request $request)
    {
        $vueRecherche = $request->input('vueRecherche');
        $allPays = $request->input('pays');
        $allDeps = $request->input('departements');
        $allVilles = $request->input('villes');
        $arraycentre = $request->input('centre');
        $centre= implode(',', $arraycentre);
        if (Carbon::parse($request->input('fin'))->gt(Carbon::parse($request->input('debut')))) {        
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
                $resultDatapay = implode(",", $payToSave);
                //dd($villelist,$departementlist,$resultDatapay);

            } elseif(!empty($allDeps)  && empty($allVilles)){
                $villelist = "";
                //les departements
                $departementlist = $allDeps;
                $payslist = $allPays;
                $paysArraylist = implode(",", $payslist);
                $deletpay = Departements::whereIn('id', $departementlist)->pluck('country_id')->implode(",");
                $departementArraylist = implode(",", $payslist);
                $departementArray = explode(",", $departementArraylist);
                $villeRemoveArray = explode(",", $deletpay);
                $resultallPays = array_diff($departementArray, $villeRemoveArray);
                $resultDatapay = implode(",", $resultallPays);
                $departementlist = implode(",", $allDeps);
                //dd($villelist, $departementlist, $resultDatapay);
            } elseif(!empty($allPays)  && empty($allDeps) && empty($allVilles)){
                $villelist = "";
                $departementlist = "";
                $resultDatapay = implode(",", $allPays);
                //dd($villelist, $departementlist, $resultDatapay);
            }
            //dd($villelist, $departementlist, $resultDatapay);

            //dd($villelist);
            $pay = $resultDatapay;
            $dep = $departementlist;
            $vil = $villelist;
            $debut = $request->input('debut');
            $fin = $request->input('fin');
            $description = $request->input('description');
            $typetache = $request->input('typetache');
            $request->session()->put('pays', $pay);
            $request->session()->put('departements', $dep);
            $request->session()->put('ville', $vil);
            $request->session()->put('centre', $centre);
            $request->session()->put('vueRecherche', $vueRecherche);
            $request->session()->put('debut', $debut);
            $request->session()->put('fin', $fin);
            $request->session()->put('description', $description);
            $request->session()->put('typetache', $typetache);
            if ($request->file('avatar')) {
                $fichier = $request->file('avatar');
                // Vérification de l'extension du fichier
                if ($typetache == '4' && !in_array($fichier->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                    return redirect()->back()->with('error', 'Le fichier doit être une image.');
                } elseif ($typetache == '3' && !in_array($fichier->getClientOriginalExtension(), ['mp4', 'mov', 'avi', 'wmv'])) {
                    return redirect()->back()->with('error', 'Le fichier doit être une vidéo.');
                } elseif ($typetache == '2' && !in_array($fichier->getClientOriginalExtension(), ['mp3','wav','aiff','wma','aac','flac','ogg','m4a'])) {
                    return redirect()->back()->with('error', 'Le fichier doit être une audio.');
                }

                $path = $fichier->store('public/fichiers');
                $img = substr($path, 6);
                $request->session()->put('pays', $pay);
                $request->session()->put('departements', $dep);
                $request->session()->put('ville', $vil);
                $request->session()->put('centre', $centre);
                $request->session()->put('vueRecherche', $vueRecherche);
                $request->session()->put('debut', $debut);
                $request->session()->put('fin', $fin);
                $request->session()->put('avatar', $img);
                $request->session()->put('description', $description);
                $request->session()->put('typetache', $typetache);
            } else {

            }

            $submit = $request->input('submit');

            if ($submit == 'inscription') {
                return redirect()->route('form.inscription');
            } else {
                return redirect()->route('form.connection');
            }
        } else {
            return redirect()->back()->with('info' , 'Vérifiez vos dates de début et de fin.');
        }
    }

    public function inscription(Request $request)
    {
        return view('action.inscription');
    }

    public function connection(Request $request)
    {
        return view('action.connection');
    }
}
