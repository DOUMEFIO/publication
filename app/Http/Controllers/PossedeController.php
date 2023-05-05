<?php

namespace App\Http\Controllers;

use App\Models\CentreInteret;
use App\Models\User;
use Illuminate\Http\Request;

class PossedeController extends Controller
{
    public function index(){
        return view("possede.index");
    }

    public function create(){
        $influenceur=User::all();
        $centreInteret=CentreInteret::all();
        return view("possede.create", compact("influenceur","centreInteret"));
    }

    public function store(){
        return redirect()->route("possede.index");
    }
}
