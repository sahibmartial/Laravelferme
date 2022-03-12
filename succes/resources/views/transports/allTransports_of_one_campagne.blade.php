@extends('base')
<?php
use App\Campagne;
use App\Http\Controllers\CampagneController;
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
  ?>
@section('title')
<title>ACHATS-Transports</title>
@endsection
@section('content')
<div class="text-center mt-4">
<h6> Frais-de-Transport</h6>
<form  name="myForm" action=" {{route('show_all_frais')}}" method="POST">
	{{ csrf_field() }}
   <div class="form-group">
        <!--{{ Form::label('campagne', 'Nom Campagne:') }}
            <br>
            <input type="text" name="campagne" placeholder="campagne1"
                @error('campagne') is-invalid @enderror" name="campagne" value="{{ old('campagne') }}" required autocomplete="campagne" autofocus>
                @error('campagne')
                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                @enderror  -->
        <select class="form-select" aria-label="Default select example" name="campagne" id="campagne">

            <option selected>CampagneX</option>
               @foreach ($campagnes as $campagne)
                 <option value="{{ $campagne->intitule }}">{{ $campagne->intitule }}</option>
               @endforeach
        </select>

 </div>
	<input type="submit" onclick="validateForm()" value="Soumettre">
</form>
{{--$request->campagne--}}

{{--<p><a href="{{route('transports.index')}}">Listing Transport</a></p>--}}
<hr>
<a href="/transport"> Retour Achats</a>
</div>

<script>
function validateForm() {

let errors=[];

let nom = document.forms["myForm"]["campagne"].value;

if (nom=='CampagneX') {

	errors.push('Campagne manquante.\n');
}

if (errors.length>0) {
	event.preventDefault();
	alert(errors)
}
//console.log("hello")
 /* let x = document.forms["myForm"]["fname"].value;
  if (x == "") {
    alert("Name must be filled out");
    return false;
  }*/
}
</script>
@stop



