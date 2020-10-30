<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bilan extends Model
{
    protected $fillable=['campagne_id','campagne','totalAchats','quantite_achetes','quantite_perdus','totalVentes','benefice','reserve','charges_salariale','partenaire','year','obs'];
}
