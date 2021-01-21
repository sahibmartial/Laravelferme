<?php

namespace App\Model;
use Db;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Poussin extends Model {
	protected $fillable = [
		'campagne_id',
		'campagne',
		'quantite',
		'priceUnitaire',
		'fournisseur',
		'obs', 'date_achat'];



 /**
   * 
   */
	public function getQte_Priceof_AchatsPoussins_ForThisCampagne($id) {
		//$result = Poussin::findOrFail($id);

    $collections = DB::table('poussins')->whereCampagneId($id)->get(['quantite','priceUnitaire']);
    //dump($collections);
		
      try {
      	if ($collections) {
          return $collections;		
      	}else{
          throw new \Exception("Error campagne saisir introuvable, verifier votre saisir !!!\n");
      	}
      } catch (Exception $e) {
      	//echo $e->getMessage();
      }
     
     // dd($var['campagne']);
      

	}

  /**
   * 
   */
  public function selectheadForOneCampagne($id)
  {
    $quantity    = 0;
    $collections = DB::table('poussins')->whereCampagneId($id)->get('quantite');

    try {
      if ($collections->isNotEmpty()) {

        foreach ($collections as $key => $value) {
          $quantity = $value->quantite;
        }

        return $quantity;

      } else {

        throw new \Exception("Error campagne saisir introuvable, verifier votre saisir !!!\n");
      }

    } catch (Exception $e) {

    //  echo $e->getMessage();

    }

  }

  /**
   *
   */

  public function calculateAchatHeadOfThisCampagne($id)
  {
    $som = 0;

    $result = $this->selectAllheadForOneCampagne($id);

    for ($i = 0; $i < count($result); $i++) {

      $som = $result[$i]->quantite*$result[$i]->priceUnitaire;
      //dd($som);
      // $som++;
      // dump($result[$i]->quantite." :".$result[$i]->priceUnitaire) ;
    }
    // dd($som);
    return $som;

  }

  /**
   *
   */

  public function selectAllheadForOneCampagne($id) 
  {
    $result      = array();
    $collections = DB::table('poussins')->whereCampagneId($id)->get();

    $result = $collections->toArray();
    // $result = json_decode($result, true);
    // dd($result);
    return $result;
  }

  /**
* generation du pdf achat poussins d'une campagne
*/
    
 public function downloadRecapPoussin($data)
 {
    $poussins=Poussin::whereCampagne(['campagne'=>$data])->get(['campagne','quantite','priceUnitaire','obs','created_at','date_achat','fournisseur']);
    
    return  $poussins;
    
 }


}
