<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MailChimpController extends Controller
{
    public function index(Request $request)
    {
    	//dd($request);
        $listId = env('MAILCHIMP_LIST_ID');
         $listId ='c524a98583';
        //dd($listId);
        $key='3f3bb597bf8df347a667868036e8ab53-us7';
         //'MAILCHIMP_API_KEY'

        $mailchimp = new \Mailchimp(env('3f3bb597bf8df347a667868036e8ab53-us7'));
        dd($mailchimp);

        $campaign = $mailchimp->campaigns->create('regular', [
            'list_id' => $listId,
            'subject' => 'Example Mail',
            'from_email' => $request->email,
            'from_name' => $request->nom,
            'to_name' => 'SAV-fermeMaya'

        ], [
            'html' => $request->input('content'),
            'text' => strip_tags($request->input('content'))
        ]);
      // dd($campaign);


        //Send campaign
        $response=$mailchimp->campaigns->send($campaign['id']);

      //  dd('Campaign send successfully.');
        //dump($response['complete']);
        return $response;
       
      
    }
}
