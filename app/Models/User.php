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
        'photpProfil',
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

    public function taches()
    {
        return $this->belongsToMany(Tache::class, "travailleur_tache", "idtravailleur", "idTache");
    }

    public function tachestravailleur()
    {
        return $this->belongsToMany(Tache::class, "tache_preve", "idtravailleur", "idTache")->withPivot("capture","totalVues");
    }
}
