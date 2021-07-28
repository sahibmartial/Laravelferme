<?php

namespace App\Model;
use App\Campagne;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class Bilan extends Model
{
    protected $fillable=[
       'campagne_id',
       'campagne',
       'totalAchats',
       'quantite_achetes',
       'quantite_perdus',
       'totalVentes',
       'benefice',
       'reserve',
       'charges_salariale',
       'partenaire',
       'year',
       'obs',
       'budget',
       'apportVente',
       'apportPersonnel',
       'dureeCampagne',
       'meanMasse'
      ];


    public function recapBilan($id)
    {
       $infos= Bilan::whereCampagneId(['campagneId'=>$id])->get();

       return $infos;

    }

   public function campagne()
   {
     return $this->belongsTo('App\Campagne');
   } 

   /**
    * La force des relation pour manipuler les datas 
    * Ici a je recupere les infos à partir des relation entre bilan et campagne 
    */

   public function  getInfosCampagne($campagne)
   {
   	
      return Campagne::whereIntitule(['campagne'=>$campagne])->get();
   }
   
   
   /**
    * get budget and ben of each campagne
    */

    public function getBudgetBenefice()
    {
     //  dd('Here');
      $infos= DB::select('select campagne,budget,totalAchats,totalVentes,quantite_achetes,
     quantite_perdus,benefice from bilans');
      return $infos;
    }

}
