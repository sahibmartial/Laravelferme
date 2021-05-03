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
        //dd('alerte');
        $email=$subject=$content=null;
        $mail= new MailController;
       //recuperation date du jour
       $now = Carbon::now();
       //get infos campgne
       $campagne= $this->infosCampagneStatus("EN COURS");
      
       // demarrage d partie alerte mail
       if (count($campagne)>0) {

          //recuperation date arrivé poussins une et une seule campagne en cour pour le currently
          $date_arrivePoussins=Vaccin::whereIntitulevaccin("Arrivée des poussins")->get();

            //compare id cmapagne en cours
       if($campagne[0]['id']==$date_arrivePoussins[0]['campagne_id'])
       {
          //convertion format carbon
          $datepoussins = new Carbon($date_arrivePoussins[0]['datedevaccination']);
          //calcule date  et envoi mail selon use case
           $diff = $datepoussins->diffInDays($now);
          // diff plus 1 pour correspondre au compteur car 1er jour correspond jour1
          $diff=$diff+1;

          //use case pour envoi de mail:
          $users = User::all();
          $mail= new MailController;
         //dd($users[0]['email']);
          $subject=" Suivi des Traitements de la campagne en cours";
          $content="Nous sommes le ".$now. ", jour ".$diff."  de la ".$date_arrivePoussins[0]['campagne']."<br>";
          $content.="TRAITEMENTS :<br>";  
          $today = date("Y-m-d H:i:s"); 

          switch ($diff) {

            case ($diff>=2 && $diff<=4):
   
              if ($diff==2 || $diff==3) {
                $content.="1) ANTISTRESS : Supervitassol / Panthéryl / Alfaceril <br>";
              }else{
                $content.="1) ANTISTRESS : Supervitassol / Panthéryl / Imuneo <br>";
              }
              foreach ($users as $key => $user) {
   
               $mail->sendEmailAlerteVaccin($$user['email'],$subject,$content);
              }
              try {
              Vaccin::create([
               'campagne_id'=>$date_arrivePoussins[0]['campagne_id'],
               'campagne'=>$date_arrivePoussins[0]['campagne'],
               'datedevaccination'=>$today,
               'intitulevaccin'=>'Antibiotiques',
               'obs'=>'ANTISTRESS : Supervitassol / Panthéryl / Alfaceril / Imuneo '
              ]);       
             
              } catch (\Throwable $th) {
             // dd($th->getMessage());
             return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
             }   
            
             break;
            
            case '5':
              $content.="1) 1er vaccin HB1  <br>";
              $content.="2) 1er vaccin H120  <br>";
              $content.="3) SuperVitassol /  Panthéryl / Imuneo <br>";
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
                
              } catch (\Throwable $th) {
               // dd($th->getMessage());
                return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
              }
              break;
            
            case '6':
                $content.="1) ANTISTRESS : Supervitassol / Panthéryl / Imuneo <br>";
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
                $content.="1) VITAMINES : AmineTotal / Supervitassol  <br>";
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
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
              break;   
            
            case '10':
                $content.="1) 1er vaccin de GUMBHORO :  <br>";
                $content.="2) VITAMINES : AmineTotal / Vitaminolyte Super  <br>";
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
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
              break; 
              
            case ($diff>=11 && $diff<=12) :
                $content.="1) VITAMINES: Amin'Total / Colivit AM+ / Vitamino / Vitaminolyte super <br>";
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
                $content.="1) VITAMINES: Amin'Total / Colivit AM+ / Vitamino / Vitaminolyte super <br>";
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
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
    
              break;  

            case '18':
                $content.="1) 2ième rappel vaccin  GUMBHORO :  <br>"; 
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
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
    
              break;   

            case '19':
                $content.="1) VITAMINES: Amin'Total / Colivit AM+ / Vitamino / Vitaminolyte super <br>";
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
                $content.="1) Phase de Transition Alimentaire: <br>";
      
                if ($diff==21) {
                  $content.="a) 3/4 Aliment de démarrage + 1/4 Aliment croissance <br>";
      
                  $content.="2) Anticoccidiens: Vetacox /Anticox <br>";
      
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
                  
                } catch (\Throwable $th) {
                //  dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
                }
                if ($diff==22) {
                  $content.="a) 1/2 Aliment de démarrage + 1/2 Aliment croissance <br>";
      
                  $content.="2) Anticoccidiens: Vetacox / Anticox <br>";
      
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
                  
                 } catch (\Throwable $th) {
                //  dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
                }
                if ($diff==23) {
                  $content.="a) 1/4 Aliment de démarrage + 3/4 Aliment croissance <br>";
                  $content.="2) Anticoccidiens: Vetacox / Anticox <br>";
      
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
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
                }
          
              break;   

            case ($diff>=24 && $diff<=25):
                $content.="1) Anticoccidiens: Vetacox / Anticox <br>";
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
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }  
      
              break; 

            case '26':
                $content.="1) Vitamines : Amin'Total <br>";
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
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }  
              break;

            case '27':
                $content.="1) 2ième rappel vaccin HB1 <br>";
                $content.="2) 2ième rappel vaccin H120 <br>";
                $content.="3) Vitamines: Amin'Total <br>";
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
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }  
      
              break;  

            case '28':
                $content.="1) Eau simple  <br>";
                foreach ($users as $key => $user) {
      
                  $mail->sendEmailAlerteVaccin($user['email'],$subject,$content);
                }  
              break; 

            case '29':
                $content.="1) 3ième rappel vaccin GUMBORHO: HIPRAGUMBORO GM97 / CEVAC IBDL /AVI IBD PLUS / NOBILIS 228E  <br>";
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
                $content.="1) Maladies respiratoires: Vental /Phytocuff/ Enrosol / Tylodox   <br>";
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
                  
                } catch (\Throwable $th) {
                 // dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
      
              break; 

            case '35':
                $content.="1) Vermifuges: Sulfate de piperazine /levimasol /polystrongle  <br>";
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
                $content.="1) Vitamine: Amin'Total / Colivit AM+ / Vitamino /Lobamin layer";
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
                  
                } catch (\Throwable $th) {
                //  dd($th->getMessage());
                  return redirect()->route('errors.bdInsert')->with('success',$th->getMessage());
                }
      
              break;  
            default:
                $content.="1) Campagne en cours, vigilance accru";
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
     * listing traitement vaccin pdf generation du fichier pdf
     */
    public function getRecap($request)
    {
   //  dd($request);
      $traitement=Vaccin::whereCampagne($request)->get();
      return $traitement;
     
       
    }
}
