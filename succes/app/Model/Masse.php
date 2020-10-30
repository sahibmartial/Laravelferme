<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Masse extends Model
{
    protected $fillable=['campagne_id','campagne','mean_masse','annee','obs'];
}
