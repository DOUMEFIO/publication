<?php

namespace App\Http\Controllers;
use App\Models\Paiement;
use App\Models\TachePreuve;

class PossedeController extends Controller
{
    public function paiementtache(){
        $paiements = Paiement::with('client','tache')
            ->whereNotNull('token')->paginate(10);
        return view("possede.tache", compact('paiements'));
    }

    public function paiementinfluenceur(){
        $paiements = TachePreuve::with('client')
            ->whereNotNull('tokenPaiementInfluenceur')->paginate(10);
        return view("possede.influenceur", compact('paiements'));
    }
}
