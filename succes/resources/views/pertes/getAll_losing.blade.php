@extends('base')
@section('title')
<title>Pertes-Campagne</title>
@endsection
@section('content')
<h2 class="text-center"></h2>
<form class="text-center" action=" {{route('show_all_losing')}}" method="POST">
	{{ csrf_field() }}
   <div>
                            {{ Form::label('campagne', 'Saisir Nom campagne:') }}
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
	<input type="submit" value="Soumettre">
</form>
<hr>
<p class="text-center"><a href="/achats"> Retour Achats</a></p>
{{--$request->campagne--}}

{{--<p><a href="{{route('pertes.index')}}">Listing pertes</a></p>--}}
@stop
<br>


