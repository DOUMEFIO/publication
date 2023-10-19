<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use StephaneAss\Payplus\Pay\PayPlus;

class Paiement extends Model
{
    use HasFactory;
    protected $table="paiement";
    protected $guarded=[];

    public function client()
    {
        return $this->belongsTo(User::class, 'idUer');
    }

    public static function paiementdo($vues,$data, $id_tache, $user_id){
        $co = (new PayPlus())->init();
        $co->addItem("$data->email", 3, 150, 450, "Je suis un client");
        $price = ViewPrice::where('idTache',$id_tache)->first('prixtache');
            if(!blank($price)){
                $pricetache = $price->prixinfluenceur;
            } else{
                $pricetache = Tache::where('id',$id_tache)->first('prixtachedefault');
                $pricetache = $pricetache->prixtachedefault;
            }
        $total_amount = $vues*$pricetache; // for test
        $co->setTotalAmount($total_amount);
        $co->setDescription("Achat de deux articles sur le site Jeans Missebo");
        $mail = $data->email;
        $password=$data->password;
        $co->addCustomData('email', $mail);
        $co->addCustomData('task_id', $id_tache);
        $co->addCustomData('user_id', $user_id);
        $co->addCustomData('montant', $total_amount);

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
}
