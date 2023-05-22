<?php

namespace App\Http\Controllers;

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

        if (isset($arraypay)) {
            if (isset($arraydep)) {
              if (isset($arrayvil)) {
                $vert= implode(',', $arrayvil);
                $zone="vil";
                $resultat= $vert;
              } else {
                $vert= implode(',', $arraydep);
                $zone="dep";
                $resultat=$vert;
              }
            } else {
                $vert= implode(',', $arraypay);
                $zone="pay";
                $resultat= $vert;
            }
          } else {
            $resultat= "vide";
          }

        $pay = $zone;
        $dep = $resultat;
        $debut = $request->input('debut');
        $fin = $request->input('fin');
        $description = $request->input('description');
        $typetache = $request->input('typetache');

        if ($request->hasFile('avatar')) {
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
                                           'pay' => $pay, 'dep'=>$dep, 'centre'=>$centre]);
    }

    public function connection(Request $request)
    {
        $centre = $request->session()->get('centre');
        $pay = $request->session()->get('pays');
        $dep = $request->session()->get('departements');
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
                                           'pay'=>$pay, 'dep'=>$dep, 'centre'=>$centre]);
    }
}
