@extends('base')
@section('title')
<title>Vente-campagne-en-cours</title>
@endsection
@section('content')
<h2 class="text-center">Vente en Cours </h2>
<form class="text-center" action="{{route('recap_vente_show')}}" method="POST">
	{{ csrf_field() }}
   <div>
                            {{ Form::label('campagne', 'Nom Campagne:') }}
                            <br>
                           <input type="text" name="campagne" placeholder="campagnex"
                           @error('campagne') is-invalid @enderror" name="campagne" value="{{ old('campagne') }}" required autocomplete="campagne" autofocus>
                           @error('campagne')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
	<br>
	<input type="submit" value="Soumettre" class="btn btn-lg btn-success">
</form>
{{--$request->campagne--}}

{{--<p><a href="{{route('pertes.index')}}">Listing pertes</a></p>--}}
<hr>
<p class="text-center"><a href="/achats"> Retour Achats</a></p>
@stop


