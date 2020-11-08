@extends('layout.addmorealiments')
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
<title>ACHATS-ACCESSOIRES</title>
@endsection
@section('contenu')
<h2> Get All Accessoires</h2>
<form action=" {{route('show_all_accesoires')}}" method="POST">
	{{ csrf_field() }}
   <div>
                            {{ Form::label('campagne', 'Name Campagne:') }}
                            <br>
                           <input type="text" name="campagne" placeholder="campagne1"
                           @error('campagne') is-invalid @enderror" name="campagne" value="{{ old('campagne') }}" required autocomplete="campagne" autofocus>
                           @error('campagne')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
	<br>
	<input type="submit" value="Get All">
</form>
{{--$request->campagne--}}

{{--<p><a href="{{route('accessoires.index')}}">Lister Accessoires</a></p>--}}
@stop
<br>
@section('retour')
<p><a href="/achats"> Retour Achats</a></p>
@endsection

@section('footer')
@include('layout.partials.footer')
@stop