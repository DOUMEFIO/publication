<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use App\Models\InfoInfluenceur;

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
            $message = "Bonjour monsieur, Voici votre nouvelle tâche qui débute le *$debutFormatee*
            et prend fin le *$finFormatee*. C'est un *$tachedo->type->libelle*. Le contenu est *$tachedo->description*";
        } else {
            $message = "Bonjour monsieur, Voici votre nouvelle tâche qui débute le *$debutFormatee*
            et prend fin le *$finFormatee*.  C'est un *$tachedo->type->libelle*. Il y a pas de cotenu.";
        }
        $message = $message;
        $data = [];

        $client = new Client();
        $headers = [
        'Authorization' => '01da56df-8699-483d-96a1-d4f3675b1ede',
        'X-api-key' => '0510efde-39e9-4927-a440-f9029d5997f2',
        'Content-Type' => 'application/json'
        ];

        $tacheinflus = [22968947612,22968455275,22961158910,22967710659];
            foreach ($tacheinflus as $tacheinflu) {
                $data = [
                    "receiver" => $tacheinflu,
                    "media" => "http://publication.lapieuvretechnologique.info/storage".$tachedo->fichier,
                    "message" => $message,
                    "callback_url" => ""
                ];
                $client = new Client();
                $body = json_encode($data);
                $request = new Request('POST', "http://51.161.128.10:3366/api/send_message", $headers, $body);
                $res = $client->sendAsync($request)->wait();
                dump($res->getBody()->getContents());
            }




    }

}
