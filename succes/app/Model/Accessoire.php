<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Accessoire extends Model
{
   protected $fillable=[
   	'campagne_id',
   	'campagne',
   	'libelle',
   	'quantite',
   'priceUnitaire',
    'obs','date_achat'];


    public function showallaccesoires()
    {
    	

    }

    public function downloadRecapAccessoires($data)
    {
      $accessoires=Accessoire::whereCampagne(['campagne'=>$data])->get(['campagne','quantite','priceUnitaire','obs','date_achat','libelle']);
    
    return  $accessoires;
    }


}
