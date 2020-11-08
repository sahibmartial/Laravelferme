<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $fillable=['campagne_id','campagne','montant','obs','date_achat'];
}
