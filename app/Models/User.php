<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Events\UserRegistered;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Support\Facades\Hash;
use StephaneAss\Payplus\Pay\PayPlus;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'idProfil',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    protected static function boot()
{
    parent::boot();
    static::created(function ($user) {
        event(new UserRegistered($user));
    });
}
    public function profil()
    {
        return $this->belongsTo(Profil::class,'idProfil');
    }
    public function workers()
    {
        return $this->hasMany(TravailleurTache::class);
    }

    public static function updateUser($data, $user){
        $info = ([
            'nom' => $data->first_name,
            'prenom' => $data->last_name ,
            'email' => $data->email
        ]);
        User::where("id", $user)->update($info);
    }

    public static function createUserClient($data){
        self::create([
            'nom' => $data->name,
            'prenom' => $data->prenom,
            'idProfil'=>3,
            'email'=>$data->email,
            'password' => Hash::make($data->password)
        ]);
    }

    public static function paiement($data, $id_tache, $user_id){
        $co = (new PayPlus())->init();
        $co->addItem("$data->email", 3, 150, 450, "Je suis un client");
        $total_amount = $data->vueRecherche*2; // for test
        $co->setTotalAmount($total_amount);
        $co->setDescription("Achat de deux articles sur le site Jeans Missebo");
        $mail = $data->email;
        $password=$data->password;
        $co->addCustomData('email', $mail);
        $co->addCustomData('task_id', $id_tache);
        $co->addCustomData('user_id', $user_id);

        // démarrage du processus de paiement
        // envoi de la requete
        if($co->create()) {

            // Requête acceptée, alors on redirige le client vers la page de validation de paiement
            return redirect()->to($co->getInvoiceUrl());
        }else{
            // Requête refusée, alors on affiche le motif du rejet
            return [
                "succes" => false,
                "message" => "$co->response_text"
            ];
        }
    }

    public function taches()
    {
        return $this->belongsToMany(Tache::class, "travailleur_tache", "idtravailleur", "idTache")->withPivot("capture","idAdmin","totalVues");
    }
}
