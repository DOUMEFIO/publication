<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use App\Models\InfoInfluenceur;
use App\Models\SendMessage;

class Admin extends Model
{
    use HasFactory;
    public static function sendtachewhatsap($id){
        $tachedo = Tache::with('type')->where('id',$id)->first();
        $tacheUser = TravailleurTache::where('idTache',$id)->pluck('idtravailleur')->toArray();
        $tacheinflu = InfoInfluenceur::whereIn('id_User',$tacheUser)->pluck("tel")->toArray();
        $dateDebut = Carbon::parse($tachedo->debut);
        $debutFormatee = $dateDebut->isoFormat('dddd D MMMM YYYY', 'Do MMMM YYYY');
        $dateFin = Carbon::parse($tachedo->debut);
        $finFormatee = $dateFin->isoFormat('dddd D MMMM YYYY', 'Do MMMM YYYY');
        if ($tachedo->description){
            $message = "Bonjour monsieur voici votre nouvelle tâche qui débute le $debutFormatee et prend fin le $finFormatee.
    C'est un ".$tachedo->type->libelle.". Le contenu est *$tachedo->description*.";
        } else {
            $message = "Bonjour monsieur voici votre nouvelle tâche qui débute le $debutFormatee et prend fin le $finFormatee.
    C'est un ".$tachedo->type->libelle.". Il y a pas de contenu." ;
        }
        $fichier = "http://publication.lapieuvretechnologique.info/storage".$tachedo->fichier;

        $message = $message;

        if(!blank($tachedo->fichier) && !blank($tachedo->description)){
            SendMessage::message($tacheinflu,$message);
            SendMessage::media($tacheinflu,$fichier);
        } elseif(!blank($tachedo->fichier) && blank($tachedo->description)) {
            SendMessage::media($tacheinflu,$fichier);
        } else{
            SendMessage::message($tacheinflu,$message);
        }
    }
}
