
<?php 
use App\Campagne;
use App\Http\Controllers\CampagneController;
use App\Http\Controllers\AlimentController;
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
   $campagne =$_POST['campagne'];

 // $campagne="campagne5";
        $campagne_id=0;
        $cam= new CampagneController();
        $aliment= new AlimentController();
       $campagne_id=$cam->getIntituleCampagneenCours(Str::lower($campagne));
       $results=$aliment->selectAllAlimentforthisCampagne($campagne_id);

       $total=$aliment->calculateDepenseAlimentofthiscampagne($campagne_id);

     // dump($results);
     //  dd($total);


  ?>
@extends('base')
@section('title')
<title>ACHATS-FraisTransport</title>
@endsection
@section('content')
@php
$total=null;

@endphp

@if (count($results) > 0)
<div class="float-sm-left">
  <a href="{{route('pdf_aliments',['data'=>$campagne])}}" class="btn btn-primary float-rigth mt-2">Download</a>
</div>
<div class="text-center mt-4">
  <b>{{'Recap achats Aliments de la  : '}}<b>{{$results[0]->campagne}}</b></b> 
</div>
<table class="table mt-5">
  <thead >
    <tr>
      <th scope="col">Date</th>
      <th scope="col">Campagne</th>
      <th scope="col">Libelle</th>     
      <th scope="col">Quantite</th>
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
       <td>{{ $results[$i]->libelle}}</td>
      <td>{{$results[$i]->quantite}}</td>
      <td>{{$results[$i]->priceUnitaire}} FCFA </td>
       <td>{{ $results[$i]->obs}}</td>
      <td>{{$results[$i]->quantite * $results[$i]->priceUnitaire }} FCFA</td> 

      @php
     $total=$total+$results[$i]->quantite * $results[$i]->priceUnitaire;
     
    @endphp
    </tr> 
    
    @endfor
  </tbody>
  <tr>
    <th colspan="6">Total:</th>
      <td><b>{{$total}}</b> FCFA</td>
    </tr>  
</table>
@else
Aucun Aliment enregistré pour la campagne !!

@endif

<hr>
<p class="text-center"><a href="/achats"> Retour Achats</a></p>
@stop



