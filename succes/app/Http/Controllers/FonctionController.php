<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\CampagneController;
use App\Campagne;

class FonctionController extends Controller
{
    public function generateObsBilan($ben,$campagne)
    {
    	if ($ben<50000) {
              $obs=$campagne. "Net progression";
            }elseif ($ben < 100000) {
                $obs= $campagne. " acceptable";
            }elseif ($ben > 100000) {
                $obs= $campagne. " excellente";
            }
    	
    	return $obs;
    }


    public function getIdcampagne($campagne){
    	$cam= new CampagneController();
       $id=$cam->getCampagneenCours();
     // dd( $id);
       for ($i=0; $i <$id->count(); $i++) { 
     $resultid[]=$id[$i]->id;
     $resultname[]=$id[$i]->intitule;

      if($campagne == $id[$i]->intitule){
         $campagne_id=$id[$i]->id;
      }
     }

        return $campagne_id;
    }


    public function getlistcampagneencours(){
    	$cam= new CampagneController();
       $id=$cam->getCampagneenCours();

       for ($i=0; $i <$id->count(); $i++) { 
     $resultid[]=$id[$i]->id;
     $resultname[]=$id[$i]->intitule;

      /*if($campagne == $id[$i]->intitule){
         $campagne_id=$id[$i]->id;
      }*/
     }

        return $resultname;
    }

    public function create(){
     return view('admin.create');

    }

    public function getAutocompleteData(Request $request){
        //if($request->has('term')){
            return dd(Campagne::whereStatus(['status'=>'EN COURS'])->get(['id','intitule']));
           // dd($request);
       // }

    }

    public function getYear($date){

      $value = preg_split('/-/', $date);
  
     
           return $value[0];


    }

    public function addmorealiments($collection,$arrayName){

      $arrayName2= array('campagne_id' => $arrayName['campagne_id'], "campagne" => "campagne2",
          "libelle" => "aliments croissance",
          "quantite" => "3",
           "priceUnitaire" => "5000",
         "fournisseur" => "sahib",
         "date_achat"=>"datecreate"
         );

      for ($i=0; $i <count($collection); $i++) { 
        $results[]=$arrayName2= array('campagne_id' => $arrayName['campagne_id'],
        "date_achat"=>$collection[$i]['date_achat'],
         "campagne" => $collection[$i]['campagne'],
          "libelle" => $collection[$i]['libelle'],
          "quantite" =>$collection[$i]['quantite'],
           "priceUnitaire" =>$collection[$i]['priceUnitaire'],
         "fournisseur" => $collection[$i]['fournisseur'],
         "obs" => $collection[$i]['obs']
         );
        }

        return $results;
    }


    public function addmoreaccessoires($collection,$arrayName){

      $arrayName2= array('campagne_id' => $arrayName['campagne_id'], "campagne" => "campagne2",
        "date_achat"=>"2020-11-11",
          "libelle" => "aliments croissance",
          "quantite" => "3",
           "priceUnitaire" => "5000",
         "obs" => "Testing"
         );

      for ($i=0; $i <count($collection); $i++) { 
        $results[]=$arrayName2= array('campagne_id' => $arrayName['campagne_id'],
          "date_achat"=>$collection[$i]['date_achat'],
         "campagne" => $collection[$i]['campagne'],
          "libelle" => $collection[$i]['libelle'],
          "quantite" =>$collection[$i]['quantite'],
           "priceUnitaire" =>$collection[$i]['priceUnitaire'],
         "obs" => $collection[$i]['obs']
         );
        }

        return $results;
    }

   public function download(){

      $fichier = $_GET['fichier'];
      $file = fopen($fichier,'a+');
    if ($file)
  { // laden und Richtung Browser ausgeben -> ergo Download
        $fichiername = basename($fichier);
        $size = filesize($fichier);
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        //header("Cache-Control: private",false);
        //header("Content-Type: application/csv-tab-delimited-table");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment; filename=\"".$fichiername."\";");
        header("Content-Description: File Transfer");
        header("Content-Transfer-Encoding: binary");
        header('Content-Length: '.$size );
        flush();

        while (!feof($file)) {
            print(fread($file,(4096 * 8)));
            flush();
        }
    }
    fclose($file);
    die();
   }


  
 
   
}
