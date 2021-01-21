<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class MailController extends Controller
{
	public function basic_email() {
      $data = array('name'=>"Sahib");
      // $message = array('message' =>"Basic Email Sent. Check your inbox.");
   
      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('sahibmartial@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('sahibmartial@gmail.com','KB');
      });
      echo "Basic Email Sent. Check your inbox.";
 
   }
   
   public function html_email() {
      $data = array('name'=>"Sahib");
      Mail::send('mail', $data, function($message) {
         $message->to('sahibmartial@gmail.com', 'Tutorials Point')->subject
            ('Laravel HTML Testing Mail');
         $message->from('sahibmartial@gmail.com','Marubo');
      });
      echo "HTML Email Sent. Check your inbox.";
   }
   public function attachment_email() {
      $data = array('name'=>"Sahib");
      Mail::send('mail', $data, function($message) {
         $message->to('sahibmartial@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('/home/laravel/appweb/Laravelferme/succes/public/assets/img/maya2.PNG');
        // $message->attach('/home/laravel/appweb/Laravelferme/succes/public/assets/test.txt');
         $message->from('sahibmartial@gmail.com','Sahib');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }
    
}
