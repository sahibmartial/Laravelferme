
@if($resultcampagne)
<div class="row mt-2 ">
	<div class="col-lg-0 mt-2">
            <a class="btn btn-info" href="/achats">retour Achats</a>

            <a class="btn btn-success" href="{{route('bilan_achats')}}">Show</a>
        </div>
  <hr>  
    </div>

  <div class="text-center">
                <h2>Detail Partiel  de la Campagne <b>{{$campagne}}</b> </h2>
    </div>
      
   @php
  $total=0
   @endphp
   
   <div class="text-center">
    <table class="table table-bordered ">
        <tr>
            <th>Date-Creation</th>
            <th>Nom</th>
            <th>Satus</th>
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
                    <b><center>{{$resulat_vente['T_vente']}} FCFA</center></b>
                    
                </td>

                <td><b>{{ $totalacces }} FCFA</b></td>
                <td><b>{{ $totalfood }} FCFA</b></td>
                <td><b>{{ $totalfrais }} FCFA</b></td>
                 <td><b>{{ $total+$totalacces+ $totalfood+$totalfrais}} FCFA</b></td>
               {{-- <td>
                    <form action="{{ route('entretien.destroy',$interview['_id']) }}" method="POST" onsubmit="return confirm('Etes vous sure?');">
                        <a class="btn btn-info" href="{{ route('entretien.show',$interview['_id']) }}">Show</a>
                        <a class="btn btn-primary" href="{{ route('entretien.edit',$interview['_id']) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>--}}
            </tr>
    </table>
</div>

@php
$pdf->pdfDownloadBilan($campagne);

@endphp

<div class="text-center"><a href="{{route('pdf_bilan',['data'=>$campagne])}}">Download</a></div>
@else
<div class="btn btn-info mt-3"><a href="/achats">{{$notification}}</a> </div>
<hr>
@endif
