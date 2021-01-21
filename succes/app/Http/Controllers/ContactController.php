<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MailChimpController;

class ContactController extends Controller
{

     public function contact(){

     	return view('contact.contact');
     }

     public function sendmessage(Request $request){
        //dd($request);
     	$notification=null;
     	$mail= new MailchimpController();

     	$response=$mail->index($request);
     	//dump($response);

     	if ($response['complete']) {
         $notification='votre mail a été bien envoyé nous vous repondrons dans un plus  bref délai.';
         return view('contact.contact')->with('notification', $notification);
     	}
     	
     	
     
     	//dd($notification);


     	
     	 return redirect()->route('contact');
     }



      public function qui_ns_sommes(){

     	return view('contact.qui_ns_sommes');
     }


}
