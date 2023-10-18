<?php

namespace App\Console\Commands;

use App\Models\InfoInfluenceur;
use App\Models\TachePreuve;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;

class GeneratePaiementmensuel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-paiementmensuel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $influhebdo = InfoInfluenceur::where('paiement','Mensuel')
            ->select('tel', 'id_User')
            ->get()
            ->keyBy('id_User');
        $idUser = [];
        foreach ($influhebdo as $influenceur) {
            $idUser[] = $influenceur->id_User;
        }
        $preuves = TachePreuve::whereIn('idtravailleur', $idUser)
            ->select('idtravailleur','id', \DB::raw('SUM(totalVues) as nbrvues'))
            ->whereNull('tokenPaiementInfluenceur')
            ->groupBy('idtravailleur','id')
            ->get();
            foreach ($preuves as $resultat) {
                $idtravailleur = $resultat->idtravailleur;
                if ($influhebdo->has($idtravailleur)) {
                    $resultat->tel = $influhebdo[$idtravailleur]->tel;
                }
            }
        //dd($preuves,$idUser);

        $url = "https://app.payplus.africa/pay/v01/straight/payout";
        foreach ($preuves as $preuve){
            $client = new Client();
            $payload = [
                "commande" => [
                    "amount" => ($preuve->nbrvues)*2,
                    "customer" => $preuve->tel,
                    "custom_data" => [
                        "transaction_id"=> "202212091606",
                        "hash"=>"f918c54d54cdc334ade09f8c228a224b1d3df646250c84dcdd99af528ddcd450"
                    ],
                    "callback_url"=> "",
                    "external_id"=>"202212091606"
                ]
            ];
            $payload = array(
                'base_uri' => $url,
                'headers' => [
                    'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZF9hcHAiOiIzMjcxIiwiaWRfYWJvbm5lIjo4MjA2LCJkYXRlY3JlYXRpb25fYXBwIjoiMjAyMy0wNi0wOSAxMTowMToxMCJ9.BdZggaEwEEeX6dFlbLVQHAuqAPdOZc3xV77BgtqGkXI',
                    'Apikey' => 'FYI06BB8TA8R3KCT7',
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode( $payload, JSON_UNESCAPED_SLASHES),
                'verify' => false,
                'exceptions' => false,
                'timeout' => 30
            );
            try{
                $res = $client->request('POST', $url, $payload);
                $responseData = json_decode($res->getBody().PHP_EOL, true);
                $token = $responseData['token'];
                //echo json_encode($payload).PHP_EOL;
                //echo 'recipient => '.$preuve.' , status : '.$res->getStatusCode().PHP_EOL;
                DB::table('tache_preve')->where('id', $preuve->id)->update(['tokenPaiementInfluenceur' => $token]);
                //echo $token;
                //echo $res->getBody().PHP_EOL;
                if($res->getStatusCode() == 201 || $res->getStatusCode() == 200){
                    $resp = json_decode($res->getBody(), true);
                }else{}
            }catch (GuzzleException $e){

            }
        }
    }
}
