<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\MailController;

class ContactController extends Controller
{

     public function contact(){

     	return view('contact.contact');
     }

     public function sendmessage(Request $request){
        //dd($request);
     	$notification=null;
     	$mail= new MailController();
		 $reference= uniqid();
		 $subject="Prise de contact reference: ".$reference;
        
     	$response=$mail->recieveMessageContact($request->email,$request->name,$subject,$request->content);
     //	dd($response);
     	if ($response) {
		 $content="Bonjour ".$request->name. " nous avons reçu votre message reference ".$reference." notre SAV vous contactera merci à bientôt. <br>"; 
		 $responseack= $mail->sendContact($request->email,$request->name,$subject,$content);	
		 if($responseack) {
			$notification='votre mail a été bien envoyé nous vous repondrons dans un plus  bref délai.';
			return view('contact.contact')->with('notification', $notification);
		 }
         
     	}
     	  	
     	//dd($notification);
     	
     	 return redirect()->route('contact');
     }



      public function qui_ns_sommes(){

     	return view('contact.qui_ns_sommes');
     }


}
