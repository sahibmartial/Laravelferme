<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Poussin extends Model
{
    protected $fillable=['campagne','quantite','priceUnitaire','fournisseur','obs'];
}
