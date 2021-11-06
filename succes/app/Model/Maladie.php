<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Maladie extends Model
{

    protected $fillable=[
     'date',
    'campagne_id',
    'campagne',
    'jours',  
    'symptomes',
    'traitements'
    ];
    
    /**
     * Campagne
     *
     * @return void
     */
    public function campagne()
    {
        return $this->belongsTo('App\Campagne');
    }


    
}
