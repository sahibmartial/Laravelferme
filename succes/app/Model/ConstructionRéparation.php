<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ConstructionRéparation extends Model
{
    protected $fillable = [
        'date',
        'materiel',
        'quantite',
        'PriceUnitaire',
        'obs'
      ];

   

}
