<?php

namespace App\Http\Controllers;

use App\Models\CentreInteret;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;

class PossedeController extends Controller
{
    public function index(){
        $paiements = Paiement::with('client')->get();
        return view("possede.index", compact('paiements'));
    }
}
