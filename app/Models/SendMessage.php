<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;

class SendMessage extends Model
{
    use HasFactory;
    public static function message($tacheinflu,$message){
        $url = "http://51.161.128.10:3366/api/send_message";
        foreach ($tacheinflu as $recipient){
            $client = new Client();
            $payload = [
                "receiver" => $recipient,
                "media" => "",
                "message" => $message,
                "callback_url" => ""
            ];
            $payload = array(
                'base_uri' => $url,
                'headers' => [
                    'Authorization' => '01da56df-8699-483d-96a1-d4f3675b1ede',
                    'X-api-key' => '0510efde-39e9-4927-a440-f9029d5997f2',
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode( $payload, JSON_UNESCAPED_SLASHES),
                'verify' => false,
                'exceptions' => false,
                'timeout' => 30
            );
            try{
                $res = $client->request('POST', $url, $payload);
                //echo json_encode($payload).PHP_EOL;
                //echo 'recipient => '.$recipient.' , status : '.$res->getStatusCode().PHP_EOL;
                //echo $res->getBody().PHP_EOL;
                return back()->with('ifo', 'La tâche a été distribiée');
                if($res->getStatusCode() == 201 || $res->getStatusCode() == 200){
                    //$resp = json_decode($res->getBody(), true);
                }else{}
            }catch (GuzzleException $e){

            }
        }
    }

    public static function media($tacheinflu,$fichier){
        $url = "http://51.161.128.10:3366/api/send_message";
        foreach ($tacheinflu as $recipient){
            $client = new Client();
            $payload = [
                "receiver" => $recipient,
                "media" => $fichier,
                "message" => "",
                "callback_url" => ""
            ];
            $payload = array(
                'base_uri' => $url,
                'headers' => [
                    'Authorization' => '01da56df-8699-483d-96a1-d4f3675b1ede',
                    'X-api-key' => '0510efde-39e9-4927-a440-f9029d5997f2',
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode( $payload, JSON_UNESCAPED_SLASHES),
                'verify' => false,
                'exceptions' => false,
                'timeout' => 30
            );
            try{
                $res = $client->request('POST', $url, $payload);
                //echo json_encode($payload).PHP_EOL;
                //echo 'recipient => '.$recipient.' , status : '.$res->getStatusCode().PHP_EOL;
                //echo $res->getBody().PHP_EOL;
                return back()->with('ifo', 'La tâche a été distribiée');
                if($res->getStatusCode() == 201 || $res->getStatusCode() == 200){
                   // $resp = json_decode($res->getBody(), true);

                }else{

                }
            }catch (GuzzleException $e){

            }
        }
    }
}
