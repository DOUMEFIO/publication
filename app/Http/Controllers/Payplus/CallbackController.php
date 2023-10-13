<?php
namespace App\Http\Controllers\Payplus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\InfoInfluenceur;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;

class CallbackController extends Controller
{
    function confirmWhatsappNumber(Request $request)
    {
        Log::info($request->all());
        $status = $request->linked;

        if ($status) {
            InfoInfluenceur::where('tel', $request->phone)
                        ->update(['validation' => 1]);

        }
    }

    function checkPhone($tel) {
        $url = "http://51.161.128.10:3366/api/check/$tel";
        $client = new \GuzzleHttp\Client();
    
        $payload = [
            'headers' => [
                'Authorization' => '01da56df-8699-483d-96a1-d4f3675b1ede',
                'X-api-key' => '0510efde-39e9-4927-a440-f9029d5997f2',
                'Content-Type' => 'application/json'
            ],
            'verify' => false,
            'exceptions' => false,
            'timeout' => 30
        ];
    
        try {
            $res = $client->request('GET', $url, $payload);
    
            if ($res->getStatusCode() == 200) {
                $response = json_decode($res->getBody());
                if($response->linked){
                    DB::update('update info_influenceur set validation = 1 where tel = ?', [$tel]);
                    return back()->with('info','Vote numéro a été lié.');
                }
                echo json_encode($response).PHP_EOL;
            } else {
                return back()->with('info',"Vote numéro n'ai pas été lié.");
            }
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            return back()->with('info',"Vote numéro n'ai pas été lié.");
        }
    }
}
