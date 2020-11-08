<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Perte extends Model
{
  protected $fillable=[
   	'campagne_id',
   	'campagne',
    'quantite',
    'cause',
    'obs',
    'duredevie',
    'year',
    'date_die'

];

     

}
