<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    /**
     * catch error  insert in bd 
     */
    public function index()
    {
        $errors="DB insertion erreur thank you";
        return view('errors.bdInsert',compact('errors'));
    }
}
