<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Masse extends Model
{
    protected $fillable=[
        'date',
    'campagne_id',
    'campagne',
    'aliment',
    'quantite',
    'mean_masse',
    'annee',
    'obs'];
}
