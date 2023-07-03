<?php

namespace App\Http\Controllers;
use App\Mail\NewUserWelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

use Illuminate\Http\Request;

class RegistrationLinkController extends Controller
{
    public static function send($email)
    {
        // mail password reset link to the newly created user
        $status = Password::sendResetLink(['email' => $email], function ($user, $token) {
            Mail::to($user->email)->send(new NewUserWelcomeMail(
                $user,
                $token
            ));
        });

        return $status == Password::RESET_LINK_SENT
                ? back()->with('status', __($status))
                : back()->withInput($email)
                        ->withErrors(['email' => __($status)]);
    }
}
