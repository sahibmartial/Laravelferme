<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Mail;
use Mailjet\Resources;
use Mailjet\Client;

class MailController extends Controller
{

   private $api_key='411eb9077b5603415b40b9894cea5e1c';
   private $api_secret='6ca5b185e43bcf8749797376678f6595';

    public function send($to_email,$to_name,$subject,$content)
      {
        // dump('sommes in send');

          $mj = new Client($this->api_key,$this->api_secret,true,['version' => 'v3.1']);
         // dd($mj);
          //$mj = new MailjetClient(getenv('MJ_APIKEY_PUBLIC'), getenv('MJ_APIKEY_PRIVATE'),true,['version' => 'v3.1']);
          //alixya09@gmail.com,"weddingalixmartial@gmail.com",
          //"Mail de confirmation de votre invitation au mariage du duo parfait"
          $body = [
              'Messages' => [
                  [
                      'From' => [
                          'Email' => "company.maya1@gmail.com",
                          'Name' => "TEAM_MAYA"
                      ],
                      'To' => [
                          [
                              'Email' => $to_email,
                              'Name' => $to_name
                          ]
                      ],
                      'TemplateID' => 2411042,
                      'TemplateLanguage' => true,
                      'Subject' => $subject ,
                      'Variables' => [
                      'content' => $content,
                      
                      ]
                      
                  ]
              ]
          ];
          $response = $mj->post(Resources::$Email, ['body' => $body]);
    
          
          $response->success();
          //dd($response->getData());
      }

       /**
       * send email contact user 
       */
      public function sendContact($to_email,$to_name,$subject,$content)
      {
          $mj = new Client($this->api_key,$this->api_secret,true,['version' => 'v3.1']);
          
          //$mj = new MailjetClient(getenv('MJ_APIKEY_PUBLIC'), getenv('MJ_APIKEY_PRIVATE'),true,['version' => 'v3.1']);
          //alixya09@gmail.com,"weddingalixmartial@gmail.com",
          //"Mail de confirmation de votre invitation au mariage du duo parfait"
          $body = [
              'Messages' => [
                  [
                      'From' => [
                          'Email' => "company.maya1@gmail.com",
                          'Name' => "TEAM_MAYA"
                      ],
                      'To' => [
                          [
                              'Email' => $to_email,
                              'Name' => $to_name
                          ]
                      ],
                      'TemplateID' => 2295318,
                      'TemplateLanguage' => true,
                      'Subject' => $subject ,
                      'Variables' => [
                      'content' => $content,
                      
                      ]
                      
                  ]
              ]
          ];
          $response = $mj->post(Resources::$Email, ['body' => $body]);
    
          
          $response->success();
          //dd($response->getData());
      }
       /**
       * send email contact user 
       */
      public function sendEmailPwd($to_email,$subject,$content)
      {
          $mj = new Client($this->api_key,$this->api_secret,true,['version' => 'v3.1']);
          
          //$mj = new MailjetClient(getenv('MJ_APIKEY_PUBLIC'), getenv('MJ_APIKEY_PRIVATE'),true,['version' => 'v3.1']);
          //alixya09@gmail.com,"weddingalixmartial@gmail.com",
          //"Mail de confirmation de votre invitation au mariage du duo parfait"
          $body = [
              'Messages' => [
                  [
                      'From' => [
                          'Email' => "company.maya1@gmail.com",
                          'Name' => "TEAM_MAYA"
                      ],
                      'To' => [
                          [
                              'Email' => $to_email,
                              
                          ]
                      ],
                      'TemplateID' => 2411042,
                      'TemplateLanguage' => true,
                      'Subject' => $subject ,
                      'Variables' => [
                      'content' => $content,
                      
                      ]
                      
                  ]
              ]
          ];
          $response = $mj->post(Resources::$Email, ['body' => $body]);
    
          
          $response->success();
          //dd($response->getData());
      }


}
