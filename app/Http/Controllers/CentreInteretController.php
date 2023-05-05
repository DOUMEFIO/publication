<?php

namespace App\Http\Controllers;

use App\Models\CentreInteret;
use Illuminate\Http\Request;

class CentreInteretController extends Controller
{
   public function index(){
        $centreInterets=CentreInteret::all();
        return view("centreInteret.index", compact("centreInterets"));
   }

   public function create(){
    return view("centreInteret.create");
   }

   public function store(Request $request){
    CentreInteret::create([
        'libelle'=>$request->libelle
    ]);
    return redirect()->route("centreInteret.index");
   }
}
