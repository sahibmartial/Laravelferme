<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vente extends Model
{
    protected $fillable=[
    	'campagne_id',
    	'campagne',
    	'quantite',
    	'priceUnitaire',
    	'acheteur',
    	'contact',
    	'events',
    	'obs'
    ];
}
