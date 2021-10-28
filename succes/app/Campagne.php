<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * ClientController short of the class
 * 
 * @category CategoryName
 * @package  PackageName
 * @author   Original Author <author@example.com>
 * @license  http://www.php.net/license/3_01.txt  PHP License 3.01
 * @link     http://pear.php.net/package/PackageName
 */
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
     * Apports
     *
     * @return $apports
     */
    public function apports()
    {
         //  dd("form");
         return $this->hasMany('App\Model\Apport');
    } 
       
    /**
     * SumApportsOfcampagne
     *
     * @param  mixed $campagne_id
     * 
     * @return $apport
     */
    public function sumApportsOfcampagne($campagne_id)
    {
         return Campagne::find($campagne_id)->apports->sum('apport');

    }


   
    /**
     * Masse of this campagne
     *
     * @return void
     */
    public function masse()
    {

         return $this->hasMany('App\Model\Masse');
    } 
   
    /**
     * MeanMasse
     *
     * @param  mixed $id_campagne
     * 
     * @return $meanmasse
     */
    public function meanMasse($id_campagne)
    {
        return Campagne::find($id_campagne)->masse->avg('mean_masse');
    }
    
    /**
     * GetDureeCampagne by id
     *
     * @param  mixed $id
     * 
     * @return void
     */
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
             return 'campagne introuvable : '.$id;
        }
  
        return $duree;
    }

   
    /**
     * Bilan get of this campagne
     *
     * @return void
     */
    public function bilan()
    {
  
          return $this->hasOne('App\Model\Bilan');

    }

    
    /**
     * GetApport of this campagne
     *
     * @param  mixed $campagne_id
     * 
     * @return $array
     */
    public function getApport($campagne_id)
    {
  
         return Campagne::find($campagne_id)->apports->all();
  
    }

    
    /**
     * Vaccin of this campagne
     *
     * @return void
     */
    public function vaccin()
    {
  
            return $this->hasMany('App\Model\Vaccin');
    }
    
    /**
     * Poussins of this campagne
     *
     * @return $collection
     */
    public function poussins()
    {

          return $this->hasMany('App\Model\Poussin');

    }
    
    /**
     * Transport of this campagne
     *
     * @return $collection
     */
    public function transport()
    {
  
        return $this->hasMany('App\Model\Transport');

    }
    
    /**
     * GetInfosCampagneById 
     *
     * @param  mixed $id
     * 
     * @return $collection
     */
    public function getInfosCampagneById($id)
    {
        try {
            return campagne::whereId($id)->get();
        } catch (\Throwable $th) {
            return "campagne not found by id : ".$id;
        }
     
    }
         
     /**
      * GetInfosCampagne
      *
      * @param  mixed $name

      * @return $collection
      */
    public function getInfosCampagne($name)
    {
        try {
            $infos=Campagne::whereIntitule($name)->get();
        } catch (\Throwable $th) {
            return "campagne not found by name : ".$name;
        }
         return $infos;
        
    }

         
      /**
       * GetCampagnebyStatus
       *
       * @return $collection
       */
    public function getCampagnebyStatus()
    {
        try {
            $infos=Campagne::whereStatus("EN COURS")->get('id');

            if ($infos->isNotEmpty()) {
                return $infos[0]['id'];
            } else {
                return "Aucune en Campagne en cours";
            }
        
        } catch (\Throwable $th) {
            return "Statut not found";
        }
       
     
       
         
    }

  
}