<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Aliment extends Model
{
	public $table = "aliments";//nom de ma table 
    protected $fillable=[
'campagne_id', 
'campagne',
'libelle',
'quantite',
'priceUnitaire',
'fournisseur',
'obs','date_achat'];


  public function downloadRecapAliments($data)
   {
    $aliments=Aliment::whereCampagne(['campagne'=>$data])->get(['campagne','quantite','priceUnitaire','obs','date_achat','libelle']);
    
    return  $aliments;
   }

 

}
