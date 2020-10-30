<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Campagne extends Model
{
    protected $fillable=['intitule','start','end','status','obs'];
    
}
