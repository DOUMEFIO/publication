<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class Admin extends Model
{
    use HasFactory;
    public static function sendtachewhatsap($id){
        $tachedo = Tache::with('type')->where('id',$id)->first();
        $tacheUser = TravailleurTache::where('idTache',$id)->pluck('idtravailleur')->toArray();
        $tacheinflu = InfoInfluenceur::whereIn('id_User',$tacheUser)->pluck('tel')->toArray();
        $dateDebut = Carbon::parse($tachedo->debut);
        $debutFormatee = $dateDebut->isoFormat('dddd D MMMM YYYY', 'Do MMMM YYYY');
        $dateFin = Carbon::parse($tachedo->debut);
        $finFormatee = $dateFin->isoFormat('dddd D MMMM YYYY', 'Do MMMM YYYY');
        if ($tachedo->description){
            $message = "Bonjour1 monsieur voici vos nouveau tâche qui début le ".$debutFormatee. " et prend fin le ".$finFormatee. " C'est un ".$tachedo->type->libelle. " La description est <strong> $tachedo->description</strong>";
        } else {
            $message = "Bonjour monsieur voici vos nouveau tâche qui début le ".$debutFormatee. " et prend fin le ".$finFormatee. " C'est un ".$tachedo->type->libelle.". Il y a pas de description." ;
        }
        $message = $message;
        //dd($message, $tachedo->description, $tachedo->fichier,$tacheinflu);
        $client = new Client();
        $headers = [
        'Authorization' => '01da56df-8699-483d-96a1-d4f3675b1ede',
        'Apikey' => '0510efde-39e9-4927-a440-f9029d5997f2',
        'Content-Type' => 'application/json'
        ];
        foreach ($tacheinflu as $destinataire) {
            $destinataire = preg_replace('/\D/', '', $destinataire);
            $body = [
                "receiver" => $destinataire,
                "media" => $tachedo->fichier,
                "message" => $message,
                "callback_url" => "",
            ];
            $request = new Request('POST', 'http://51.161.128.10:3366/api/send_message', $headers, $body);
            $res = $client->sendAsync($request)->wait();
            echo $res->getBody();
        }
    }

}
