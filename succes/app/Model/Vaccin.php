<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Campagne;
class Vaccin extends Model
{
    protected $fillable=[
    	'campagne_id',
    	'campagne',
        'datedevaccination', 	
    	'intitulevaccin',	
   	 	'obs'
    ];
  


  public function campagne()
   {
     return $this->belongsTo('App\Campagne');
   } 


   public function infosCampagne($id)
   {
   	 return Campagne::whereId($id)->get();
   }
}
