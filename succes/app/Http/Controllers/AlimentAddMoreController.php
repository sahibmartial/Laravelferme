<?php

namespace App\Http\Controllers;

use App\Campagne;
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
        //dd($request);
        $campagne_id=0;
        $campagne="";
        $cam= new CampagneController();
        $aliment= new FonctionController();

        foreach ($request->addmore as $key => $value) {

            $campagne=$value['campagne'];
        }

        $campagne_id=$cam->getIntituleCampagneenCours($campagne);
        $arrayName =array('campagne_id'=> $campagne_id);

        if (isset($arrayName['campagne_id'])) {


            $campagne=Campagne::findorfail($arrayName['campagne_id']);
            // dd($campagne);
            $qteAlimentdemarrage=$campagne['alimentDemaDispo'];
            $qteAlimentcroissance=$campagne['alimentCroisDispo'];
            $collection=$request->addmore;
            $result=$aliment->addmorealiments($collection, $arrayName);
            $request->validate(
                [
                 'addmore.*.date_achat' => 'bail|required',

                 'addmore.*.campagne' => 'bail|required',

                  'addmore.*.libelle' => 'bail|required',

                  'addmore.*.quantite' => 'bail|required',

                  'addmore.*.priceUnitaire' => 'bail|required',

                 'addmore.*.fournisseur' => 'bail|required',
                 'addmore.*.contact' => 'bail|required',

                'addmore.*.obs' => 'bail|required',
                ]
            );
            foreach ($result as $key => $value) {
                //dd($value);
                try {
                    Aliment::create($value);

                    //update alimentDema or croisssance campagne selon type aliment

                    if ($value ['libelle']=='ALIMENT DÉMARRAGE') {
                         $newvalue=$value['quantite']+$qteAlimentdemarrage;
                        // dd($newvalue);
                        $campagne->update(
                            [
                              'alimentDemaDispo'=>$newvalue
                            ]
                        );

                    } elseif ($value ['libelle']=='ALIMENT CROISSANCE') {
                            $newvalue=$value['quantite']+$qteAlimentcroissance;
                           // dd($newvalue);

                            $campagne->update(
                                [
                                  'alimentCroisDispo'=>$newvalue
                                ]
                            );

                    }


                } catch (\Throwable $th) {
                     throw $th;
                }

            }
               return back()->with('success', 'Achat Aliment enregistré avec  Success.');

        } else {
            return back()->with('success', 'Enregistrement Impossible, '.$campagne.' introuvable,merci');

        }

    }
}
