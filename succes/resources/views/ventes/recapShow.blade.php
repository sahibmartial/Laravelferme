@extends('base')
@section('title')
<title>Vente-Recap</title>
@stop
@section('content')
@php
$total=null;
$quantity=null;
@endphp
<div class="float-sm-left">
  <a href="{{route('pdf_vente',['data'=>$campagne])}}" class="btn btn-primary float-rigth mt-2">Download</a>
</div>
<div class="float-sm-right">
	<a href="/ferme" class="btn btn-primary float-rigth mt-2">Retour Menu</a>
</div>

@if (count($result) > 0)
<div class="text-center mt-2">
	<b>{{'Recap des ventes'}}-{{$result[0]->campagne}}</b> 
</div>
<table class="table mt-5">
  <thead >
    <tr>
      <th scope="col">Campagne</th>
      <th scope="col">Quantite</th>
      <th scope="col">Priceunitaire</th>
      <th scope="col">Date-Vente</th>
      <th scope="col">Date-Enregistrement</th>
      <th scope="col">Total</th>
    </tr>
  </thead>
  <tbody>


  	@for ($i = 0; $i < count($result); $i++)
       {{--<option value="{{ $i }}">{{ $i }}</option>--}}
  	
    <tr>
      <th scope="row">{{$result[$i]->campagne}}</th>
      <td>{{$result[$i]->quantite}}</td>
      <td>{{$result[$i]->priceUnitaire}} FCFA </td>
      <td>{{$result[$i]->obs}}</td>
      <td>{{$result[$i]->created_at}}</td>
      <td>{{$result[$i]->quantite * $result[$i]->priceUnitaire }} FCFA</td> 

      @php
     $total=$total+$result[$i]->quantite * $result[$i]->priceUnitaire;
     $quantity=$quantity+$result[$i]->quantite;
    @endphp
    </tr> 
    
   
    @endfor
  </tbody>
  <tr>
  	<th colspan="0">Total:</th>
  	<td><b>{{$quantity}}</b></td>
  	<th colspan="3"></th> 
      <td><b>{{$total}}</b> FCFA</td>
    </tr>  
</table>
@else
Aucune vente pour la campagne selecionnée !!

@endif

@stop