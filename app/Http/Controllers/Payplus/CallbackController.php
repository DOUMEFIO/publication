<?php
namespace App\Http\Controllers\Payplus;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class CallbackController extends Controller
{
    function confirmWhatsappNumber(Request $request)
    {
        Log::info($request->all());
    }
}
