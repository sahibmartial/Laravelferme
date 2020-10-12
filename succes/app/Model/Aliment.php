<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Aliment extends Model
{
    protected $fillable=[
'campagne_id', 
'campagne',
'libelle',
'quantite',
'priceUnitaire',
'fournisseur',
'obs'];
}
