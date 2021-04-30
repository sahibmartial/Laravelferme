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
        return view('errors.bdInsert');
    }
}
