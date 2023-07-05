<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Waspay</title>
</head>
<body>
   @if ($user->idProfil==2)
        @csrf
        <p style="text-align: center">Bonjour Mr/Mlle <strong>{{ $user->nom }} {{ $user->prenom }}</strong>vous a ajouté sur notre plateforme <strong>Waspay</strong>.
        </p>
        Veuillez accepté pour continuer<br>
        <a href="{{route('confirm', ['id'=> $user->id])}}">C'est moi</a>
   @else
   <p style="text-align: center">Bonjour Mr/Mlle <strong>{{ $user->nom }} {{ $user->prenom }}</strong>vous a ajouté sur notre plateforme <strong>Waspay</strong>.
   </p>
   @endif

</body>
</html>
