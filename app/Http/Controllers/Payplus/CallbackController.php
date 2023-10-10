<?php
namespace App\Http\Controllers\Payplus;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\InfoInfluenceur;
use Illuminate\Support\Facades\Log;

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
}
