<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Apport extends Model
{
     protected $fillable=['campagne_id','campagne','apport','obs'];

/**
 * Cette fonction recupere tous les apports d'une campagne a partir de l'id campgne 
 */
     public function getApportOfCampagne($id)
     {
       $apports=Apport::whereCampagneId(['campagne_id'=>$id])->get(['campagne_id','apport','obs','created_at']);
    
    return  $apports;
     }


 public function campagne()
   {
       return $this->belongsTo('App\Campagne');
   }

  /**
   * save apports 
   */ 

   public static function getApports()
   {

       $apports = Apport::select()
           ->orderBy('id')
           ->simplePaginate(5);

       return $apports;
   }
  

}
