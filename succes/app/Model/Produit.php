<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    protected $fillable=[
    	'id',
    	'title',
    	'subTitle',
    	'slug',
    	'illustration',
    	'description'
    ];


  /**
    * 
    */
    
 public function getProduits()
 {
 	
    
 }

}
