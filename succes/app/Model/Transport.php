<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $fillable=['campagne_id','campagne','montant','obs','date_achat'];

/**
* generation du pdf frais de transport d'une campagne
*/
    
 public function downloadRecapFrais($data)
 {
    $frais=Transport::whereCampagne(['campagne'=>$data])->get(['campagne','montant','obs','created_at','date_achat']);
    
    return  $frais;
    
 }

}
