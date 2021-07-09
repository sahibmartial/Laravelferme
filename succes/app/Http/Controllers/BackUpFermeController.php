<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class BackUpFermeController extends Controller
{
    public  function backupfile($folder,$removename,$contents){
        
        Storage::disk('public')->put($folder.$removename.'',$contents);
    }

   
}
