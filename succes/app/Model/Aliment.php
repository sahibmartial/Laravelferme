<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Aliment extends Model
{
	public $table = "aliments";//nom de ma table 
    protected $fillable=[
'campagne_id', 
'campagne',
'libelle',
'quantite',
'priceUnitaire',
'fournisseur',
'obs','date_achat'];
}
