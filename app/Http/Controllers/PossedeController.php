<?php

namespace App\Http\Controllers;

use App\Models\CentreInteret;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;

class PossedeController extends Controller
{
    public function index(){
        $paiements = Paiement::with('client')->paginate(10);
        return view("possede.index", compact('paiements'));
    }
}
