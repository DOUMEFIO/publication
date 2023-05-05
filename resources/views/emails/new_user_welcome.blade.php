@component('mail::message')
# Bienvenue, {{ $user->name }} !

Merci d'avoir rejoint notre communauté. Nous sommes heureux de vous compter parmi nos membres.

@component('mail::button', ['url' => $link_url])
Visitez notre site web
@endcomponent

Cordialement,<br>
L'équipe Example
@endcomponent
