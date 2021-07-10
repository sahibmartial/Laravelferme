<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Campagne;
use Illuminate\Support\Facades\DB;
class Perte extends Model
{
  protected $fillable=[
   	'campagne_id',
   	'campagne',
    'quantite',
    'cause',
    'obs',
    'suggestion',
    'duredevie',
    'year',
    'date_die'

];

/**
 * calcul total pertes of this campagne
 */

public function pertesOfthisCampagne($value)
{
	$total_quantity=null;
     $collections=DB::table('pertes')->whereCampagne(Str::lower($value))->get(['campagne','quantite','duredevie']);

     foreach ($collections as $key => $value) {
         
       //dump($value);
        $total_quantity=$total_quantity+$value->quantite;

     }
    // dump($total_quantity);
     //dump($total_vente);
     $result=['T_qte'=>$total_quantity];

    return  $result;
}



/**
* generation du pdf des pertes d'une campagne
*/
    
 public function downloadRecapPerte($data)
 {
    $pertes=Perte::whereCampagne(['campagne'=>$data])->get(['campagne','obs','created_at','date_die','duredevie','quantite','cause']);
    
    return $pertes;
    
 }

 /**
  * recup data pertes campagne en cours
  */
  
  public function pertes_campagne_en_cours()
  {
     try {
      $campagne=Campagne::whereStatus('En COURS')->get();
      if (isset($campagne[0]['id'])) {
         $resultsPertes=Perte::whereCampagne_id($campagne[0]['id'])->get();
         return $resultsPertes;

      } else {
         return 'Campagne introuvable';
      }
      
     } catch (\Throwable $th) {
        throw $th;
     }

  }
     

}
