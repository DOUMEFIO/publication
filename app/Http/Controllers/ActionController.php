<?php

namespace App\Http\Controllers;

use App\Models\Departements;
use App\Models\Villes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActionController extends Controller
{
    public function index(Request $request)
    {
        $vueRecherche = $request->input('vueRecherche');
        $arraypay = $request->input('pays');
        $arraydep = $request->input('departements');
        $arrayvil = $request->input('villes');
        $arraycentre = $request->input('centre');
        $centre= implode(',', $arraycentre);
        //dd($arraypay, $arrayvil, $arraydep);
        if(!empty($arrayvil)){
            $zone1 = "vil";
            //les villes
            $villelist = implode(',', $arrayvil);
            $ids = explode(",", $villelist);
            $deletdep = Villes::whereIn('id', $ids)->pluck('state_id')->implode(",");
            $departementlist= implode(',', $arraydep);
            $departementArray = explode(",", $departementlist);
            $villeRemoveArray = explode(",", $deletdep);
            $resultArray = array_diff($departementArray, $villeRemoveArray);
            $resultData = implode(",", $resultArray);
            //dd($villelist, $departementlist, $deletdep, $resultData);
            if(!empty($resultData)){
                //les departements
                $departementlist = $resultArray;
                $deletpay = Departements::whereIn('id', $departementlist)->pluck('country_id')->implode(",");
                $listpay= implode(',', $arraypay);
                $paysArray = explode(",", $listpay);
                $payRemoveArray = explode(",", $deletpay);
                $resultArraypay = array_diff($paysArray, $payRemoveArray);
                $departementlist = implode(",", $departementlist);
                //les pays
                $resultDatapay = implode(",", $resultArraypay);
                //dd($listpay, $deletpay,$resultDatapay);
            }else{
                //les departements
                $ids = explode(",", $departementlist);
                //dd($departementlists);
                $deletpay = Departements::whereIn('id', $ids)->pluck('country_id')->implode(",");
                //dd($deletpay);
                $listpay= implode(',', $arraypay);
                $paysArray = explode(",", $listpay);
                $payRemoveArray = explode(",", $deletpay);
                $resultArraypay = array_diff($paysArray, $payRemoveArray);
                //les pays
                $resultDatapay = implode(",", $resultArraypay);
                $departementlist = "";
                //dd($listpay, $deletpay,$resultDatapay);
            }
            //dd($villelist, $departementlist, $resultDatapay);
        } elseif(!empty($arraydep)  && empty($arrayvil)){
            $villelist = "";
            //les departements
            $departementlist = $arraydep;
            $payslist = $arraypay;
            $paysArraylist = implode(",", $payslist);
            $deletpay = Departements::whereIn('id', $departementlist)->pluck('country_id')->implode(",");
            $departementArraylist = implode(",", $payslist);
            $departementArray = explode(",", $departementArraylist);
            $villeRemoveArray = explode(",", $deletpay);
            $resultArraypay = array_diff($departementArray, $villeRemoveArray);
            $resultDatapay = implode(",", $resultArraypay);
            $departementlist = implode(",", $arraydep);
            //dd($villelist, $departementlist, $resultDatapay);
        }elseif(!empty($arraypay)  && empty($arraydep) && empty($arrayvil)){
            $villelist = "";
            $departementlist = "";
            $resultDatapay = implode(",", $arraypay);
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
            $request->session()->put('pays', $pay);
            $request->session()->put('departements', $dep);
            $request->session()->put('ville', $vil);
            $request->session()->put('centre', $centre);
            $request->session()->put('vueRecherche', $vueRecherche);
            $request->session()->put('debut', $debut);
            $request->session()->put('fin', $fin);
            $request->session()->put('avatar', $path);
            $request->session()->put('description', $description);
            $request->session()->put('typetache', $typetache);
        } else {
            $request->session()->put('pays', $pay);
            $request->session()->put('departements', $dep);
            $request->session()->put('ville', $vil);
            $request->session()->put('centre', $centre);
            $request->session()->put('vueRecherche', $vueRecherche);
            $request->session()->put('debut', $debut);
            $request->session()->put('fin', $fin);
            $request->session()->put('description', $description);
            $request->session()->put('typetache', $typetache);
        }

        $submit = $request->input('submit');


        if ($submit == 'inscription') {
            return redirect()->route('form.inscription');
        } else {
            return redirect()->route('form.connection');
        }
    }

    public function inscription(Request $request)
    {
        $centre = $request->session()->get('centre');
        $pay = $request->session()->get('pays');
        $dep = $request->session()->get('departements');
        $vil = $request->session()->get('ville');
        $vueRecherche = $request->session()->get('vueRecherche');
        $debut = $request->session()->get('debut');
        $fin = $request->session()->get('fin');
        $avatar = $request->session()->get('avatar');
        $url = Storage::url($avatar);
        $description = $request->session()->get('description');
        $fin = $request->session()->get('fin');
        $typetache = $request->session()->get('typetache');
        return view('action.inscription', ['vueRecherche' => $vueRecherche, 'debut' => $debut ,'fin' => $fin,
                                           'url' => $url, 'description' => $description,'typetache' => $typetache,
                                           'pay' => $pay, 'dep'=>$dep, 'vil'=>$vil, 'centre'=>$centre]);
    }

    public function connection(Request $request)
    {
        $centre = $request->session()->get('centre');
        $pay = $request->session()->get('pays');
        $dep = $request->session()->get('departements');
        $vil = $request->session()->get('ville');
        $vueRecherche = $request->session()->get('vueRecherche');
        $debut = $request->session()->get('debut');
        $fin = $request->session()->get('fin');
        $avatar = $request->session()->get('avatar');
        $url = Storage::url($avatar);
        $description = $request->session()->get('description');
        $fin = $request->session()->get('fin');
        $typetache = $request->session()->get('typetache');
        return view('action.connection', ['vueRecherche' => $vueRecherche, 'debut' => $debut ,'fin' => $fin,
                                           'url' => $url, 'description' => $description,'typetache' => $typetache,
                                           'pay'=>$pay, 'dep'=>$dep, 'vil'=>$vil, 'centre'=>$centre]);
    }
}
