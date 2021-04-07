<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Aliment;
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\FonctionController;
class AlimentAddMoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addMore()

    {

        return view("aliments.addMore");

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function addMorePost(Request $request)

    {
    	$campagne_id=0;
    	$campagne="";
    	
 // dd($request->addmore);
        

        $cam= new CampagneController();
        $aliment= new FonctionController();
        foreach ($request->addmore as $key => $value) {
        	 
             $campagne=$value['campagne'];
        }

       $campagne_id=$cam->getIntituleCampagneenCours($campagne);
       $arrayName =array('campagne_id'=> $campagne_id);
    //  dd($arrayName);
     //dump($request->addmore);
      $collection=$request->addmore;
      $result=$aliment->addmorealiments($collection,$arrayName);

   //   dd($result);
   
      	//$result = array_merge($arrayName,$collection);
      	//$collection[0][0]=$arrayName['campagne_id'];
      	/*$arrayName2= array('campagne_id' => $arrayName['campagne_id'], "campagne" => "campagne2",
      		"libelle" => "aliments croissance",
      		"quantite" => "3",
           "priceUnitaire" => "5000",
         "fournisseur" => "sahib"
         );

      	for ($i=0; $i <count($collection); $i++) { 
      	$result[]=$arrayName2= array('campagne_id' => $arrayName['campagne_id'],
      	 "campagne" => $collection[$i]['campagne'],
      		"libelle" => $collection[$i]['libelle'],
      		"quantite" =>$collection[$i]['quantite'],
           "priceUnitaire" =>$collection[$i]['priceUnitaire'],
         "fournisseur" => $collection[$i]['fournisseur']
         );
      	}*/

      	//dd($result);     
        
         //dd($request->addmore);
      
     // $tab['campagne_id'] = $campagne_id;

        $request->validate([
          'addmore.*.date_achat' => 'bail|required',

            'addmore.*.campagne' => 'bail|required',

            'addmore.*.libelle' => 'bail|required',

            'addmore.*.quantite' => 'bail|required',

            'addmore.*.priceUnitaire' => 'bail|required',

            'addmore.*.fournisseur' => 'bail|required',

            'addmore.*.obs' => 'bail|required',
            
        ]); 

        foreach ($result as $key => $value) {
        //	dd($value);
           Aliment::create($value);
        }
        
        return back()->with('success', 'Aliment enregistrée avec  Success.');

    }
}
