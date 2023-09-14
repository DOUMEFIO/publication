<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $user=User::where('email',$request->email)->first();
        if(!blank($user) && Hash::check($request->password, $user->password)){
            $users=User::where('email',$request->email)->get('idProfil');
            if($users[0]->idProfil == 1){
                $request->authenticate();

                $request->session()->regenerate();

                return redirect()->intended(RouteServiceProvider::ADMIN);
            } elseif ($users[0]->idProfil == 2) {
                $request->authenticate();

                $request->session()->regenerate();

                return redirect()->intended(RouteServiceProvider::TRAVAILLEURCONNECT);
            } elseif ($users[0]->idProfil == 3) {
                $request->authenticate();

                $request->session()->regenerate();

                return redirect()->intended(RouteServiceProvider::HOME);
            } 
        } elseif(!blank($user) && !Hash::check($request->password, $user->password)){
            return redirect()->back()->with('info2', 'Mot de passe incorrect'); 
        }
        else{
        return redirect()->back()->with('info2', "L'utilisateur n'a pas été trouvé");
       }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
