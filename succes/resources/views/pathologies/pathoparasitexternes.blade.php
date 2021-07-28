@extends('base')
@section('title')
<title>Maladies Parasitaires Externes </title>
@endsection
@section('content') 
<div class="text-center mt-4">

<h5 class="p-3 mb-2 bg-info text-white">LES MALADIES PARASITAIRES EXTERNES:</h5>

{{--dd($Mparisitaires)--}}
<div class="table-responsive">
  <table class="table">
  <thead>
                    <tr>
                    <th scope="col">Definition</th>
                    <th scope="col">Symptômes</th>
                    <th scope="col">Traitements</th>
                    <th scope="col">Prophylaxie-Sanitaire</th>
                    <th scope="col">Prophylaxie-Vaccinale</th>
                    </tr>
                </thead>
                <tbody>
                  
                    <tr>
                    <td>{{$Mparisitaires['Définition']}}</td>
                    <td class="table-danger"> {{$Mparisitaires['Symptômes']}}

                    </td>
                    <td class="table-info">{{$Mparisitaires['Traitement']}}</td>
                    <td class="table-info">{{$Mparisitaires['Prophylaxie-Sanitaire']}}</td>
                    <td class="table-info">{{$Mparisitaires['Prophylaxie-Vaccinale']}}

                    </td>
                   
                    </tr>
                 
                </tbody>
   
  </table>
</div>

<hr>
<p><a href="/ferme"> Retour Board</a></p>
</div>
@stop