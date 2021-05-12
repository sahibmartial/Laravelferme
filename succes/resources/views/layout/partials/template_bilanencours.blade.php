
@if($campagneInfos->count()>0)

<div class="row mt-4">
	<div class="col-lg-0 mt-2">
            <a class="btn btn-info ml-3" href="/achats">retour Achats</a>

            <a class="btn btn-success" href="{{route('bilan_achats')}}">Show</a>
        </div>
  <hr>  
    </div>

  <div class="text-center">
                <h2>Detail Partiel <b>{{$campagne}}</b> </h2>
    </div>
      
   
   <div class="text-center">
    <table class="table table-bordered ">
        <tr>
            <th>Date</th>
            <th>Nom</th>
            <th>Satus</th>
            <th>Budget</th>
            <th>Apports</th>
             <th>T_Achats_Poussins</th>
             <th>Pertes&Invendus/Poussins</th>
             <th>T_Vente_Poussins</th>
            <th>T_accessoires</th>
            <th>T_Aliments</th>
            <th>T_tranport</th>
            <th>T_Achats</th>
            <!--<th width="280px">Action</th>-->
        </tr>

            <tr>
                <td>{{ $campagneInfos[0]['start'] }}</td>
                <td>{{ $campagneInfos[0]['intitule']}}</td>
                <td>{{ $campagneInfos[0]['status'] }}</td>
                <td>{{$campagneInfos[0]['budget'] }} FCFA</td>
                <td>
                <a href="{{route('apports.index')}}"><center>{{ 'Issu des Ventes : '.$apportVente }} </a> FCFA</center>
                <hr>
                <a href="{{route('apports.index')}}"><center>{{'Personnel :'.$apportpersonel }}</a> FCFA</center>
                      
                </td>
                <td colspan="1">
                <center>{{ 'qte : '.$resultbilan['qtePoussins'] }} | {{'price_U : '.$resultbilan['PousPUAchat'] }} FCFA</center>
                <hr>
                <b><center>{{ $total=$resultbilan['qtePoussins'] * $resultbilan['PousPUAchat'] }} FCFA</center></b>   
                </td>
                <td colspan="1">
                <center>{{'Pertes : ' .$resultbilan['resultat_pertes']['T_qte']}} </center> 
                    <hr>
                <b><center>{{'Restant : '. ($resultbilan['qtePoussins'] - ($resultbilan['resultat_pertes']['T_qte']+ $resultbilan['resulat_vente']['T_qte']))}}</center></b>
                </td>
                 <td colspan="1">
                    <center>{{ 'qte vendu : '.$resultbilan['resulat_vente']['T_qte']}} </center>
                    <hr>
                    <center><b>{{'Recette:'.$resultbilan['resulat_vente']['T_vente']}}</b> FCFA</center>
                    <center><b>{{'Solde:'.($resultbilan['resulat_vente']['T_vente'] - $apportVente)}}</b> FCFA</center>
                    
                </td>

                <td><b>  {{ $resultbilan['totalacces'] }} FCFA</b></td>
                <td><b>  {{ $resultbilan['totalfood'] }} FCFA</b></td>
                <td><b> {{ $resultbilan['totalfrais'] }} FCFA</b></td>
                 <td><b>  {{ $total+$resultbilan['totalacces']+ $resultbilan['totalfood'] + $resultbilan['totalfrais']}} FCFA</b></td>
               
            </tr>
    </table>
</div>

<div class="text-center"><a href="{{route('pdf_bilan',['array'=>$campagne])}}">Download</a></div>
@else
<div class="alert alert-success mt-3"><a href="/achats">{{$notification}}</a> </div>
<hr>
@endif
