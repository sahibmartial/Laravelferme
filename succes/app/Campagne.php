<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Stmt\Foreach_;

class Campagne extends Model
{
    protected $fillable=[
      'intitule',
      'budget',
      'start',
      'end',
      'status',
      'duree',
      'alimentDemaDispo',
      'alimentDemaUtil',
      'alimentCroisDispo',
      'alimentCroisUtil',
      'obs'];

/**
 * retourne une collection des apports dont id identique a campagne
 */

    public function apports()
    {
   //  dd("form");
     return $this->hasMany('App\Model\Apport');
    } 
   /**
    * apports est une collection du coup j'applique les methods utiles pour faire la somme
    * des apports de la campagne à partir de l'id
    *calcule la somme des apports e parcourant la collection
    */  
 public function sumApportsOfcampagne($campagne_id)
 {
 	
  return Campagne::find($campagne_id)->apports->sum('apport');
// 
 }


/**
 * retourne une collection des masses liées  à la campagne 
 */
 public function masse()
    {
   //  dd("form");
     return $this->hasMany('App\Model\Masse');
    } 
/**
 * Applique la fonction average pour avoir la moyenne des mean_masse(champ de otre table masse)
 */
 public function meanMasse($id_campagne)
 {
  return Campagne::find($id_campagne)->masse->avg('mean_masse');
 }

 public  function getDureeCampagne($id)
 {
  $duree=0;
   try {
    $result=Campagne::whereId($id)->get('duree');
    if ($result->isNotEmpty()) {
      foreach ($result as $key => $value) {
        $duree=$value['duree'];
      }

    } else {
      return "Aucun resulat trouve pour cet Id:".$id;
    }
    
    
   } catch (\Throwable $th) {
     throw $th;
   }
  
   return $duree;
 }

/**
 * retourne une collection
 */
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

    public function poussins()
    {
   //  dd("form");
     return $this->hasMany('App\Model\Poussin') ;

    }

    public function transport()
    {
   //  dd("form");
     return $this->hasMany('App\Model\Transport') ;

    }

    public function getInfosCampagneById($id)
    {
      try {
        return   campagne::whereId($id)->get();
      } catch (\Throwable $th) {
        throw $th;
      }
    
    }
     /**
      * recuper infos campagne a partir de son intitule
      */
     public function getInfosCampagne($name)
     {
       try {
        $infos=Campagne::whereIntitule($name)->get();
       } catch (\Throwable $th) {
         throw $th;
       }
       return $infos;
        
     }

     /**
      * recuper infos campagne a partir de son intitule
      */
      public function getCampagnebyStatus()
      {
        try {
          $infos=Campagne::whereStatus("EN COURS")->get('id');

          if($infos->isNotEmpty()){
            return $infos[0]['id'];
          }else{
            return "Aucune en Campagne en cours";
          }
        
        } catch (\Throwable $th) {
          throw $th;
        }
       
     
       
         
      }

  
}