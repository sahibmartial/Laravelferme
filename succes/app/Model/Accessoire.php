<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Accessoire extends Model
{
   protected $fillable=['campagne','libelle','quantite',
   'priceUnitaire',
'obs'];
}
