
<?php 
use App\Campagne;
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\TransportController;
  $result = array();
//echo "string";
$cam= new CampagneController();
 $id=$cam->getCampagneenCours();
  //$var= $id->toJson();
 // dump($id);
 for ($i=0; $i <$id->count(); $i++) { 
 	//dump($id[$i]->id);
 	 $result[]=$id[$i]->intitule;
 }

//echo "string";
$cam= new Campagne();
 $id=$cam::all();
  $var= $id->toJson();
   $campagne =Str::lower($_POST['campagne']);

 // $campagne="campagne5";
        $campagne_id=0;
        $cam= new CampagneController();
        $frais= new TransportController();
       $campagne_id=$cam->getIntituleCampagneenCours(Str::lower($campagne));
       $results=$frais->selectAllFraisTrasnportForOneCampagne($campagne_id);

       $total=$frais->calculateFraisTotalOfCampagne($campagne_id);

     // dd($results);
      // dd($total);

    


  ?>
@extends('base')
@section('title')
<title>ACHATS-FraisTransport</title>
@endsection
@section('content')
@if (count($results) > 0)
<div class="text-left"><a href="{{route('pdf_transport',['data'=>$campagne])}}">download</a></div>
<div class="text-center mt-2">
  <b>{{'Recap Frais transport de la '}}{{$results[0]->campagne}}</b> 
</div>
<table class="table mt-5">
  <thead >
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Campagne</th>    
      <th scope="col">Montant</th>
       <th scope="col">Observations</th>
      <th scope="col">DepensesT</th>
      
    </tr>
  </thead>
  <tbody>
    @for ($i = 0; $i < count($results); $i++)
       {{--<option value="{{ $i }}">{{ $i }}</option>--}}
    
    <tr>
       <td>{{ $results[$i]->date_achat}}</td>
      <th scope="row">{{$results[$i]->campagne}}</th>
       
      <td>{{$results[$i]->montant}} FCFA </td>
       <td>{{ $results[$i]->obs}}</td>
        <td>{{ $results[$i]->montant}} FCFA</td>
    </tr> 
    
    @endfor
  </tbody>
  <tr>
    <th colspan="4">Total:</th>
      <td><b>{{$total}}</b> FCFA</td>
    </tr>  
</table>
@else
Aucun Transport enregistré pour la campagne !!
@endif
<hr>
<p class="text-center"><a href="/achats"> Retour Achats</a></p>

@stop


