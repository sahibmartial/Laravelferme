<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Campagne;
use App\Http\Controllers\GeneratePdfController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;

class Vaccin extends Model
{
    protected $fillable=[
    	'campagne_id',
    	'campagne',
        'datedevaccination', 	
    	'intitulevaccin',	
   	 	'obs'
    ];
  


  public function campagne()
   {
     return $this->belongsTo('App\Campagne');
   } 


   public function infosCampagne($id)
   {
   	 return Campagne::whereId($id)->get();
   }

   public function infosCampagneStatus($tatut)
   {
   	 return Campagne::whereStatus($tatut)->get();
   }
   
   /**
    * alert suivi vaccin campagne
    */
   public function  alertMailingSuivi()
   {
       // dd('alerte');
        $email=$subject=$content=null;
        $mail= new MailController;
       //recuperation date du jour
       $now = Carbon::now();
       //get infos campgne
       $campagne= $this->infosCampagneStatus("EN COURS");
      
       // demarrage  partie alerte mail
       if (isset($campagne[0]['id'])) {
           
      //  dd($campagne[0]['id']);
          //recuperation date arrivé poussins une et une seule campagne en cour pour le currently
          try {
            $date_arrivePoussins=Vaccin::whereIntitulevaccin("Arrivée des poussins")->get();

          } catch (\Throwable $th) {
            throw $th;
          }
         
            //compare id cmapagne en cours
       if($campagne[0]['id']==$date_arrivePoussins[0]['campagne_id'])
       {
        //$masses=Masse::findOrFail($id);
          //recup
          try {
            $updatecampgne=Campagne::findOrFail($campagne[0]['id']);
          } catch (\Throwable $th) {
            throw $th;
          }
         
          //convertion format carbon
          $datepoussins = new Carbon($date_arrivePoussins[0]['datedevaccination']);
          //calcule date  et envoi mail selon use case
           $diff = $datepoussins->diffInDays($now);
          // diff plus 1 pour correspondre au compteur car 1er jour correspond jour1
          $diff=$diff+1;
       //  dd($diff);
          //use case pour envoi de mail:
          $users = User::all();
          $mail= new MailController;
         //dd($users[0]['email']);
          $subject=" Suivi des Traitements de la campagne en cours";
          $content="Nous sommes le ".$now. ", jour ".$diff."  de la ".$date_arrivePoussins[0]['campagne']."<br>";
          $content.="<b>TRAITEMENTS <b>:<br> <br>";  
          $today = date("Y-m-d H:i:s"); 

          switch ($diff) {

            case ($diff>=2 && $diff<=4):
   
              if ($diff==2 || $diff==3) {
                $content.="1) <b>ANTISTRESS<b> : <br> Supervitassol / Panthéryl / Alfaceril <br>";
              }else{
                $content.="1)<b> ANTISTRESS <b>: <br> Supervitassol / Panthéryl / Imuneo <br>";
              }
              foreach ($users as $key => $user) {
              // dd($user);
               $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
              }
              try {
              Vaccin::create([
               'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
               'campagne'=>$date_arrivePoussins[0]['campagne'],
               'datedevaccination'=>$today,
               'intitulevaccin'=>'Antibiotiques',
               'obs'=>'ANTISTRESS : Supervitassol / Panthéryl / Alfaceril / Imuneo '
              ]); 
              //update duree cote campge   
             
              $updatecampgne->update([
                'duree'=>$diff
               ]);   
             
              } catch (\Throwable $th) {
             // dd($th->getMessage());
             return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
             }   
            
             break;
            
            case '5':
              $content.="1) <b>1er vaccin HB1 <b> <br><br>";
              $content.="2) <b>1er vaccin H120 <b> <br> <br>";
              $content.="3) <b> SuperVitassol /  Panthéryl / Imuneo <b> <br>";
              foreach ($users as $key => $user) {
    
                $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
              }
              try {
                Vaccin::create([
                  'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                  'campagne'=>$date_arrivePoussins[0]['campagne'],
                  'datedevaccination'=>$today,
                  'intitulevaccin'=>'Vaccins',
                  'obs'=>'1er vaccin HB1, 1er vaccin H120, SuperVitassol /  Panthéryl / Imuneo '
                ]);  
                 //update duree cote campge    
                 
                 //update duree campagne
                 $updatecampgne->update([
                  'duree'=>$diff
                 ]);
                
              } catch (\Throwable $th) {
               // dd($th->getMessage());
                return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
              }
              break;
            
            case '6':
                $content.="1) <b>ANTISTRESS <b>:<br> Supervitassol / Panthéryl / Imuneo <br>";
                foreach ($users as $key => $user) {
    
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }
                try {
                  Vaccin::create([
                    'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                    'campagne'=>$date_arrivePoussins[0]['campagne'],
                    'datedevaccination'=>$today,
                    'intitulevaccin'=>'Antibiotiques',
                    'obs'=>'ANTISTRESS : Supervitassol / Panthéryl / Imuneo'
                  ]);      
                  
                  //update duree campagne
                  $updatecampgne->update([
                    'duree'=>$diff
                   ]);
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
              break;  
                
            case ($diff>=7 && $diff<=8):
                  $content.="1) Eau simple  <br>";
                  foreach ($users as $key => $user) {
      
                    $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                  }
               break; 
            
            case '9':
                $content.="1) <b>VITAMINES <b> : <br> AmineTotal / Supervitassol  <br>";
                foreach ($users as $key => $user) {
    
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }
                try {
                  Vaccin::create([
                    'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                    'campagne'=>$date_arrivePoussins[0]['campagne'],
                    'datedevaccination'=>$today,
                    'intitulevaccin'=>'Vitamines',
                    'obs'=>'VITAMINES : AmineTotal / Supervitassol'
                  ]);       

                  //update duree campagne
                  $updatecampgne->update([
                    'duree'=>$diff
                   ]);
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
              break;   
            
            case '10':
                $content.="1) <b>1er vaccin de GUMBHORO <b>:  <br><br>";
                $content.="2) <b>VITAMINES <b>: AmineTotal / Vitaminolyte Super  <br>";
                foreach ($users as $key => $user) {
    
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }
                try {
                  Vaccin::create([
                    'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                    'campagne'=>$date_arrivePoussins[0]['campagne'],
                    'datedevaccination'=>$today,
                    'intitulevaccin'=>'Vaccins',
                    'obs'=>'1er Vaccin GUMBHORO, VITAMINES : AmineTotal / Supervitassol'
                  ]);    
                  
                  //update duree campagne
                  $updatecampgne->update([
                    'duree'=>$diff
                   ]);
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
              break; 
              
            case ($diff>=11 && $diff<=12) :
                $content.="1) <b>VITAMINES<b>: <br> Amin'Total / Colivit AM+ / Vitamino / Vitaminolyte super <br>";
                foreach ($users as $key => $user) {
    
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }
                try {
                  Vaccin::create([
                    'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                    'campagne'=>$date_arrivePoussins[0]['campagne'],
                    'datedevaccination'=>$today,
                    'intitulevaccin'=>'Vitamines',
                    'obs'=>"VITAMINES : Amin'Total / Colivit AM+ / Vitamino / Vitaminolyte super"
                  ]);    
                  
                  //update duree campagne
                  $updatecampgne->update([
                    'duree'=>$diff
                   ]);
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
              break; 
              
            case  ($diff>=13 && $diff<=16):
                $content.="1) Eau simple  <br>";
                foreach ($users as $key => $user) {
    
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }
              break;  
              
            case '17':
                $content.="1) <b>VITAMINES</b>: <br/> Amin'Total / Colivit AM+ / Vitamino / Vitaminolyte super <br>";
                foreach ($users as $key => $user) {
    
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }
                try {
                  Vaccin::create([
                    'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                    'campagne'=>$date_arrivePoussins[0]['campagne'],
                    'datedevaccination'=>$today,
                    'intitulevaccin'=>'Vitamines',
                    'obs'=>"VITAMINES : Amin'Total / Colivit AM+ / Vitamino / Vitaminolyte super"
                  ]);    
                  //update duree campagne
                  $updatecampgne->update([
                    'duree'=>$diff
                   ]);   
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
    
              break;  

            case '18':
                $content.="1) <b> 2ième rappel vaccin  GUMBHORO </b> :  <br/>"; 
                foreach ($users as $key => $user) {
    
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }
                try {
                  Vaccin::create([
                    'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                    'campagne'=>$date_arrivePoussins[0]['campagne'],
                    'datedevaccination'=>$today,
                    'intitulevaccin'=>'Vaccins',
                    'obs'=>'VACCINS : 2ième rappel vaccin de GUMBHORO'
                  ]);     
                  //update duree campagne
                  $updatecampgne->update([
                    'duree'=>$diff
                   ]);  
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
    
              break;   

            case '19':
                $content.="1) <b<VITAMINES </b>: <br/> Amin'Total / Colivit AM+ / Vitamino / Vitaminolyte super <br/>";
                foreach ($users as $key => $user) {
    
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                 }
                 try {
                  Vaccin::create([
                    'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                    'campagne'=>$date_arrivePoussins[0]['campagne'],
                    'datedevaccination'=>$today,
                    'intitulevaccin'=>'Vitamines',
                    'obs'=>'VACCINS : 2ième vaccin de GUMBHORO'
                  ]);       
                  //update duree campagne
                  $updatecampgne->update([
                    'duree'=>$diff
                   ]);
                  
                 } catch (\Throwable $th) {
                //  dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                 }
    
                break;  

            case '20':
                  $content.="1) Eau simple  <br>";
                  foreach ($users as $key => $user) {
      
                    $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                  }    
               break; 

            case ($diff>=21 && $diff<=23):  
                $content.="1) <b> Phase de Transition Alimentaire </b>: <br/>";
      
                if ($diff==21) {
                  $content.="a) 3/4 Aliment de démarrage + 1/4 Aliment croissance <br/><br/>";
      
                  $content.="2) <b> Anticoccidiens </b>: <br/>Vetacox /Anticox <br/>";
      
                foreach ($users as $key => $user) {
      
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }  
      
                try {
                  Vaccin::create([
                    'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                    'campagne'=>$date_arrivePoussins[0]['campagne'],
                    'datedevaccination'=>$today,
                    'intitulevaccin'=>'Transition Aliment',
                    'obs'=>'3/4 Aliment de démarrage + 1/4 Aliment croissance + Anticoccidiens(Vetacox / Anticox ) '
                  ]);    
                  
                  //update duree campagne
                  $updatecampgne->update([
                    'duree'=>$diff
                   ]);
                  
                } catch (\Throwable $th) {
                //  dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
                }
                if ($diff==22) {
                  $content.="a) 1/2 Aliment de démarrage + 1/2 Aliment croissance <br/><br/>";
      
                  $content.="2) <b> Anticoccidiens </b>: <br/> Vetacox / Anticox <br>";
      
                foreach ($users as $key => $user) {
      
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }  
      
                try {
                  Vaccin::create([
                    'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                    'campagne'=>$date_arrivePoussins[0]['campagne'],
                    'datedevaccination'=>$today,
                    'intitulevaccin'=>'Transition Aliment',
                    'obs'=>'1/2 Aliment de démarrage + 1/2 Aliment croissance + Anticoccidiens(Vetacox / Anticox)'
                  ]);    
                  
                  //update duree campagne
                  $updatecampgne->update([
                    'duree'=>$diff
                   ]);
                  
                 } catch (\Throwable $th) {
                //  dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
                }
                if ($diff==23) {
                  $content.="a) 1/4 Aliment de démarrage + 3/4 Aliment croissance <br/><br/>";
                  $content.="2) <b>Anticoccidiens</b>: <br/> Vetacox / Anticox <br>";
      
                foreach ($users as $key => $user) {
      
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }  
      
                try {
                  Vaccin::create([
                    'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                    'campagne'=>$date_arrivePoussins[0]['campagne'],
                    'datedevaccination'=>$today,
                    'intitulevaccin'=>'Transition Aliment',
                    'obs'=>'1/4 Aliment de démarrage + 3/4 Aliment croissance + Anticoccidiens(Vetacox / Anticox) '
                  ]);   
                  //update duree campagne
                  $updatecampgne->update([
                    'duree'=>$diff
                   ]);    
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
                }
          
              break;   

            case ($diff>=24 && $diff<=25):
                $content.="1) <b>Anticoccidiens</b>: <br/> Vetacox / Anticox <br/>";
                foreach ($users as $key => $user) {
      
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }
                try {
                  Vaccin::create([
                    'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                    'campagne'=>$date_arrivePoussins[0]['campagne'],
                    'datedevaccination'=>$today,
                    'intitulevaccin'=>'Anticoccidiens',
                    'obs'=>'Anticoccidiens(Vetacox/Anticox )'
                  ]);     
                  //update duree campagne
                  $updatecampgne->update([
                    'duree'=>$diff
                   ]);  
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }  
      
              break; 

            case '26':
                $content.="1) <b> Vitamines </b> : <br/> Amin'Total <br/>";
                foreach ($users as $key => $user) {
      
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                } 
                try {
                  Vaccin::create([
                    'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                    'campagne'=>$date_arrivePoussins[0]['campagne'],
                    'datedevaccination'=>$today,
                    'intitulevaccin'=>'Vitamines',
                    'obs'=>"Vitamines : Amin'Total"
                  ]);       
                  //update duree campagne
                  $updatecampgne->update([
                    'duree'=>$diff
                   ]);
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }  
              break;

            case '27':
                $content.="1)<b> 2ième rappel vaccin HB1</b> <br/> <br/>";
                $content.="2) <b>2ième rappel vaccin H120 </b> <br/> <br/>";
                $content.="3) <b>Vitamines </b>:<br/> Amin'Total <br>";
                foreach ($users as $key => $user) {
      
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }
                try {
                  Vaccin::create([
                    'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                    'campagne'=>$date_arrivePoussins[0]['campagne'],
                    'datedevaccination'=>$today,
                    'intitulevaccin'=>'Vaccins',
                    'obs'=>"2ième Rappel  vaccin HB1 et H120 + Vitamines : Amin'Total"
                  ]); 
                  //update duree campagne
                  $updatecampgne->update([
                    'duree'=>$diff
                   ]);      
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }  
      
              break;  

            case '28':
                $content.="1) Eau simple  <br/>";
                foreach ($users as $key => $user) {
      
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }  
              break; 

            case '29':
                $content.="1) <b> 3ième rappel vaccin GUMBORHO</b>: <br/> HIPRAGUMBORO GM97 / CEVAC IBDL /AVI IBD PLUS / NOBILIS 228E  <br>";
                foreach ($users as $key => $user) {
      
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }
                try {
                  Vaccin::create([
                    'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                    'campagne'=>$date_arrivePoussins[0]['campagne'],
                    'datedevaccination'=>$today,
                    'intitulevaccin'=>'Vaccins',
                    'obs'=>"3ième Rappel vaccin GUMBORHO (souche intermediaire plus) pour les zones à forte pression virale "
                  ]);   
                  //update duree campagne
                  $updatecampgne->update([
                    'duree'=>$diff
                   ]);    
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
      
              break; 
             
            case '30':
                $content.="1) Eau simple  <br>";
                foreach ($users as $key => $user) {
      
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }  
              break;  
              
            case ($diff>=31 && $diff<=34):
                $content.="1) <b> Maladies respiratoires </b> : <br/> Vental /Phytocuff/ Enrosol / Tylodox   <br/>";
                foreach ($users as $key => $user) {
      
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }
                try {
                  Vaccin::create([
                    'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                    'campagne'=>$date_arrivePoussins[0]['campagne'],
                    'datedevaccination'=>$today,
                    'intitulevaccin'=>'Maladies Respiratoires',
                    'obs'=>"Maladies Respiratoires: Vental /Enrosol"
                  ]);  
                  //update duree campagne
                  $updatecampgne->update([
                    'duree'=>$diff
                   ]);     
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
      
              break; 

            case '35':
                $content.="1) <b> Déparasitage (Vermifuges)</b> :  <br/> Sulfate de piperazine /levimasol /polystrongle  <br/>";
                foreach ($users as $key => $user) {
      
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }
                try {
                  Vaccin::create([
                    'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                    'campagne'=>$date_arrivePoussins[0]['campagne'],
                    'datedevaccination'=>$today,
                    'intitulevaccin'=>'Vermifuges',
                    'obs'=>"Vermifuges: Sulfate de piperazine /levimasol /polystrongle "
                  ]); 
                  //update duree in campagnne 
                  $updatecampgne->update([
                    'duree'=>$diff
                   ]);
                  
                  //send email alerte vente satrt dans 5 jours
                  $subject="Alerte entrée en Production ".$campagne[0]['intitule'];
                  $contentStartvente="Nous sommes le ".$now. ", dans 5 jours démarre la vente de la campagne ".$campagne[0]['intitule']."<br/>";
                  $contentStartvente.="Large diffusion, merci .<br/>";
                  foreach ($users as $key => $user) {
      
                    $mail->sendEmailPrevisionVente($user['email'],$subject,$contentStartvente);
                  }

                } catch (\Throwable $th) {
                   // $th->getMessage();
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
              break;   

            case ($diff>=36 && $diff<=38):
                $content.="1) Eau simple  <br>";
                foreach ($users as $key => $user) {
      
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }
              break ;  
             
            case '39':
                $content.="1) <b<Vitamine </b>: <br/>Amin'Total / Colivit AM+ / Vitamino /Lobamin layer";
                foreach ($users as $key => $user) {
                 $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }
                try {
                  Vaccin::create([
                    'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
                    'campagne'=>$date_arrivePoussins[0]['campagne'],
                    'datedevaccination'=>$today,
                    'intitulevaccin'=>'Vitamines',
                    'obs'=>"Vitamine: Amin'Total / Colivit AM+ / Vitamino /Lobamin layer"
                  ]);   
                  
                  $updatecampgne->update([
                    'duree'=>$diff
                   ]);
                  
                } catch (\Throwable $th) {
                //  dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
    
              break;
              
            case '40':
                    try {
                    //update duree cote campge 
                    $updatecampgne->update([
                    'duree'=>$diff
                   ]);
               
                    } catch (\Throwable $th) {
                        throw $th;
                  }
                  //send email start campagne en production
                  $subject="Alerte Mise en Production ".$campagne[0]['intitule'];
                  $contentStartvente="Nous sommes le ".$now. ", 40 ième jours,  jour de démarrage de la vente de la campagne ".$campagne[0]['intitule']."<br/>";
                  $contentStartvente.="Large diffusion, merci .<br/>";
                  foreach ($users as $key => $user) {
      
                    $mail->sendEmailPrevisionVente($user['email'],$subject,$contentStartvente);
                  }

              break;  
            default :
            try {
               //update duree cote campge 
               $updatecampgne->update([
                 'duree'=>$diff
               ]);
              
            } catch (\Throwable $th) {
              throw $th;
            }
                 $content.="1) <b>Hygiène <b>: <br> Nettoyage complet et changement des accessoires et litières chaque 7  jours .<br> <br>"; 
                 $content.="2) <b>Traitements<b>: <br> Vetacox sur 3 jours ou 5 jours consécutifs selon la situation puis attendre 8 à 10 jours et reprendre le traitement .<br> <br>";
                 $content.="3) Campagne en cours, vigilance accrue";
                foreach ($users as $key => $user) {
                $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }
              break;
        }                       

      }
                                             

    }

          // $mail->sendEmailAlerteVaccin($email,$subject,$content);     

   }

   /**
    * alert mail arrive poussin 
    */
    public function  alertMailingArrivePoussins($content)
    {
     $email=$subject=null;
     $mail= new MailController;
     
     $users = User::all();
     //dump($users);
     $subject="Arrivé des poussins dans la ferme.";
     foreach ($users as $key => $email) {
     // dd($email);
      $mail->sendEmailAlerteVaccin($email['email'],$subject,$content); 
     } 
 
    }

    /**
    * alert mail arrive poussin 
    */
    public function  alertEmailProduction($campagne,$content)
    {
     $email=$subject=null;
     $mail= new MailController;
     
     $users = User::all();
     //dump($users);
     $subject="Date démarrage des ventes de la : ".$campagne;
     foreach ($users as $key => $email) {
     // dd($email);
      $mail->sendEmailPrevisionVente($email['email'],$subject,$content); 
     } 
 
    }

    /**
     * listing traitement vaccin pdf generation du fichier pdf
     */
    public function getRecap($request)
    {
   //  dd($request);
      $traitement=Vaccin::whereCampagne($request)->get();
      return $traitement;
        
    }

    

}
