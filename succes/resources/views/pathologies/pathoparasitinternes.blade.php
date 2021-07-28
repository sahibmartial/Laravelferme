@extends('base')
@section('title')
<title>Maladies Parasitaires Internes</title>
@endsection
@section('content') 
<div class="text-center mt-4">
<h5 class="p-3 mb-2 bg-info text-white">LES MALADIES PARASITAIRES INTERNES:</h5>
{{--dd($Mparisitaires)--}}
<div class="table-responsive">
  <table class="table-bordered">
  <thead>
                    <tr>
                    <th scope="col">Nom</th>   
                    <th scope="col">Definition</th>
                    <th scope="col">Symptômes</th>
                    <th scope="col">Traitements</th>
                    <th scope="col">Prophylaxie-Sanitaire</th>
                    <th scope="col">Prophylaxie-Vaccinale</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($Mparisitaires as $key => $virales)
                    <tr>
                    <td><b>{{$key}}</b></td>
                    <td>{{$virales['Définition']}}</td>
                    <td class="table-danger"> {{$virales['Symptômes']}}

                    </td>
                    <td class="table-info">{{$virales['Traitement']}}</td>
                    <td class="table-info">{{$virales['Prophylaxie-Sanitaire']}}</td>
                    <td class="table-info">{{$virales['Prophylaxie-Vaccinale']}}

                    </td>
                   
                    </tr>
                   @endforeach
                </tbody>
 
  </table>
</div>

<hr>
<p><a href="/ferme"> Retour Board</a></p>
</div>
@stop