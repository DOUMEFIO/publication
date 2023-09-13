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
        $allPays = $request->input('pays');
        $allDeps = $request->input('departements');
        $allVilles = $request->input('villes');
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
                $payslist = implode(",", $payToSave);
                //dd($villelist,$departementlist,$resultDatapay);

            } elseif(!empty($allDeps)  && empty($allVilles)){
                //les villes
                $villelist = "";

                //les departements
                $departementlist= implode(',', $allDeps);

                //les pays
                $deletpay = Departements::whereIn('id', $allDeps)->pluck('country_id')->toArray();
                $resultallPays = array_diff($allPays, $deletpay);
                $payslist = implode(",", $resultallPays);
                //dd($villelist, $departementlist, $resultDatapay);
            } elseif(!empty($allPays)  && empty($allDeps) && empty($allVilles)){
                //les villes
                $villelist = "";

                //les departements
                $departementlist = "";

                //les pays
                $payslist = implode(",", $allPays);
                //dd($villelist, $departementlist, $resultDatapay);
            }
            //dd($villelist, $departementlist, $payslist);

            $centre= implode(',', $request->input('centre'));

            if ($request->file('avatar')) {
                $fichier = $request->file('avatar');
                // Vérification de l'extension du fichier
                if ($request->input('typetache') == '4' && !in_array($request->file('avatar')->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                    return redirect()->back()->with('error', 'Le fichier doit être une image.');
                } elseif ($request->input('typetache') == '3' && !in_array($request->file('avatar')->getClientOriginalExtension(), ['mp4', 'mov', 'avi', 'wmv'])) {
                    return redirect()->back()->with('error', 'Le fichier doit être une vidéo.');
                } elseif ($request->input('typetache') == '2' && !in_array($request->file('avatar')->getClientOriginalExtension(), ['mp3','wav','aiff','wma','aac','flac','ogg','m4a'])) {
                    return redirect()->back()->with('error', 'Le fichier doit être une audio.');
                }

                $path = $fichier->store('public/fichiers');
                $img = substr($path, 6);
                $request->session()->put('pays', $payslist);
                $request->session()->put('departements', $departementlist);
                $request->session()->put('ville', $villelist);
                $request->session()->put('centre', $centre);
                $request->session()->put('vueRecherche', $request->input('vueRecherche'));
                $request->session()->put('debut', $request->input('debut'));
                $request->session()->put('fin', $request->input('fin'));
                $request->session()->put('description', $request->input('description'));
                $request->session()->put('typetache', $request->input('typetache'));
                $request->session()->put('avatar', $img);
            } else {
                $request->session()->put('pays', $payslist);
                $request->session()->put('departements', $departementlist);
                $request->session()->put('ville', $villelist);
                $request->session()->put('centre', $centre);
                $request->session()->put('vueRecherche', $request->input('vueRecherche'));
                $request->session()->put('debut', $request->input('debut'));
                $request->session()->put('fin', $request->input('fin'));
                $request->session()->put('description', $request->input('description'));
                $request->session()->put('typetache', $request->input('typetache'));
            }
            //dd($request->session());

            if ($request->input('submit') == 'inscription') {
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
