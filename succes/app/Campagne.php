<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campagne extends Model
{
    protected $fillable=['intitule','budget','start','end','status','obs'];


    public function apports()
    {
   //  dd("form");
     return $this->hasMany('App\Model\Apport');
    } 
   /**
    * apports est une collection du coup j'applique les methods utiles pour faire la somme des apports de la campagne à partir de l'id
    */  
 public function sumApportsOfcampagne($campagne_id)
 {
 	
/* Campagne::find(4)->apports->each(function($capital){
 	$som=0;
    $som+=$capital['apport'];
 	//dump ($capital['apport']);
 	//return $som;
     });*/
     
     //
  return Campagne::find($campagne_id)->apports->sum('apport');
// 
 }

   public function bilan()
    {
   //  dd("form");
     return $this->hasOne('App\Model\Bilan') ;

    }


    public function getApport($campagne_id)
  {
  
  return Campagne::find($campagne_id)->apports->all();
 
  }


  public function vaccin()
    {
   //  dd("form");
     return $this->hasMany('App\Model\Vaccin') ;

    }

  
}