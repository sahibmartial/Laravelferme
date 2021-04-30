<?php

namespace App\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use DB;

class Vente extends Model
{
    protected $fillable=[
    	'campagne_id',
        'date',
    	'campagne',
    	'quantite',
    	'priceUnitaire',
    	'acheteur',
    	'contact',
    	'events',
    	'obs'
    ];
  

   /**
    * 
    */
    
 public function getRecap()
 {
    
 }

 public function getRecapShow($request)
 {
      $campagne=Str::lower($request);

    //dd("in model :".$campagne);
      $collections=DB::table('ventes')->whereCampagne(Str::lower($request))->get(['campagne','date','quantite','priceUnitaire','created_at','obs']);

      return $collections->toArray();

 }

 public function calculRecapvente($request)
 {
     $total_quantity=null;
     $total_vente=null;
     $collections=DB::table('ventes')->whereCampagne(Str::lower($request))->get(['campagne','quantite','priceUnitaire','created_at']);


     foreach ($collections as $key => $value) {
         
       //dump($value);
        $total_quantity=$total_quantity+$value->quantite;
        $total_vente=$total_vente+($value->quantite*$value->priceUnitaire);


     }
    // dump($total_quantity);
     //dump($total_vente);
     $result=['T_qte'=>$total_quantity,'T_vente'=>$total_vente];

    return  $result;

 }

/**
* generation du pdf du detail des ventes d'une campagne
*/
    
 public function downloadRecapVente($data)
 {
    $ventes=Vente::whereCampagne(['campagne'=>$data])->get(['campagne','date','quantite','priceUnitaire','obs','created_at']);
    
    return  $ventes;
    
 }




}
