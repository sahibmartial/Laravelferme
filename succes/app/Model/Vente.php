<?php

namespace App\Model;

use App\Campagne;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Vente extends Model
{
    protected $fillable =
        [
     'campagne_id',
    'date',
    'campagne',
    'quantite',
    'priceUnitaire',
    'acheteur',
    'contact',
    'events',
    'avance',
     'impaye',
    'regler',
    'obs'
    ];



    public function getRecapShow($request)
    {
         $campagne=Str::lower($request);

         //dd("in model :".$campagne);
        $collections=DB::table('ventes')->whereCampagne(Str::lower($request))->get(['campagne','date','quantite','priceUnitaire','created_at','obs']);

        return $collections->toArray();

    }

    public function calculRecapvente($request)
    {
        $total_quantity=null;
        $total_vente=null;
        $collections=DB::table('ventes')->whereCampagne(Str::lower($request))->get(['campagne','quantite','priceUnitaire','created_at']);


        foreach ($collections as $key => $value) {

            //dump($value);
             $total_quantity=$total_quantity+$value->quantite;
            $total_vente=$total_vente+($value->quantite*$value->priceUnitaire);


        }
         // dump($total_quantity);
         //dump($total_vente);
        $result=['T_qte'=>$total_quantity,'T_vente'=>$total_vente];

         return  $result;

    }

   /**
   * Generation du pdf du detail des ventes d'une campagne
   */

    public function downloadRecapVente($data)
    {
        $ventes=Vente::whereCampagne(['campagne'=>$data])->get(['campagne','date','quantite','priceUnitaire','obs','created_at']);

        return  $ventes;

    }


    /**
     * Recup data vente campagne en cours
    */

    public function ventes_campagne_en_cours()
    {
        try {
            $campagne=Campagne::whereStatus('En COURS')->get();

            if (isset($campagne[0]['id'])) {
                 // dd($campagne[0]['id']);
                $resultVentes=Vente::whereCampagne_id($campagne[0]['id'])->get();

                return $resultVentes;
            } else {
                return 'Campagne Introuvable ' ;
            }

        } catch (\Throwable $th) {
            throw $th;
        }

    }
   /**
   * get Ventes inmpayés de la campagne en cours
    */
    public function ventes_impayes()
    {
        try {
            $campagne=Campagne::whereStatus('EN COURS')->get('id');
            // dd($campagne);

        } catch (\Throwable $th) {
            throw $th;
        }
        if (isset($campagne[0]['id'])) {
            $reglement="NOK";
            $resultVentes=Vente::whereCampagne_id($campagne[0]['id'])
                ->where('regler', 'NOK')
                ->orderbydesc('id')
                ->get();

        }
        return  $resultVentes;
    }

/**
 * get Ventes inmpayés de la campagne en cours
 */
    public function ventes_regler($id)
    {
           $reglement="OK";

        try {
            $campagne=Campagne::whereId($id)->get();

            if (isset($campagne[0]['id'])) {

                $resultVentes=Vente::whereCampagne_id($campagne[0]['id'])

                 ->Where('regler', 'OK')
                    ->orderbydesc('id')
                    ->get();

            } else {
                return 'Campagne Introuvable' ;
            }

        } catch (\Throwable $th) {
            throw $th;
        }



        return  $resultVentes;
    }

}
