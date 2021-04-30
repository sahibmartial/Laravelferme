
@if($resultcampagne)
<div class="row mt-2 ">
	<div class="col-lg-0 mt-2">
            <a class="btn btn-info" href="/achats">retour Achats</a>

            <a class="btn btn-success" href="{{route('bilan_achats')}}">Show</a>
        </div>
  <hr>  
    </div>

  <div class="text-center">
                <h2>Detail Partiel <b>{{$campagne}}</b> </h2>
    </div>
      
   @php
  $total=0
   @endphp
   
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
                <td>{{ $resultcampagne['start']}}</td>
                <td>{{ $resultcampagne['intitule']}}</td>
                <td>{{ $resultcampagne['status'] }}</td>
                <td>{{$budget}} FCFA</td>
                <td>
                    <a href="{{route('apports.index')}}"><center>{{ 'Issu des Ventes : '.$apportVente }} </a> FCFA</center>
                    <hr>
                    <center><a href="{{route('apports.index')}}">{{'Personnel :'.$apportpersonel }}</a> FCFA</center>
                </td>
                <td colspan="1">
                    <center>{{ 'qte : '.$qtyhead }} | {{'price_U : '.$priceU}} FCFA</center>
                    <hr>
                    <b><center>{{ $total=$qtyhead * $priceU }} FCFA</center></b>
                    
                </td>
                <td colspan="1">
                    <center>{{'Pertes : ' .$resultat_pertes['T_qte']}} </center> 
                    <hr>
                    <b><center>{{'Restant : '. ($qtyhead - ($resultat_pertes['T_qte']+ $resulat_vente['T_qte']))}}</center></b>
                </td>
                 <td colspan="1">
                    <center>{{ 'qte vendu : '.$resulat_vente['T_qte']}} </center>
                    <hr>
                    <center><b>{{'Recette:'.$resulat_vente['T_vente']}}</b> FCFA</center>
                    <center><b>{{'Solde:'.($resulat_vente['T_vente'] - $apportVente)}}</b> FCFA</center>
                    
                </td>

                <td><b>{{ $totalacces }} FCFA</b></td>
                <td><b>{{ $totalfood }} FCFA</b></td>
                <td><b>{{ $totalfrais }} FCFA</b></td>
                 <td><b>{{ $total+$totalacces+ $totalfood+$totalfrais}} FCFA</b></td>
               
            </tr>
    </table>
</div>

@php
$pdf->pdfDownloadBilan($campagne);

@endphp

<div class="text-center"><a href="{{route('pdf_bilan',['data'=>$campagne])}}">Download</a></div>
@else
<div class="alert alert-success mt-3"><a href="/achats">{{$notification}}</a> </div>
<hr>
@endif
