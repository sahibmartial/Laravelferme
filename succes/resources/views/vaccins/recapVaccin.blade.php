@extends('base')
@section('title')
<title>Vaccin-Recap</title>
@endsection
@section('content')

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

<h2 class="text-center">Suivi Traitements </h2>
<form class="text-center" action="{{route('downloadrecap_vaccin')}}" method="POST">
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

<hr>
<p class="text-center"><a href="{{route('vaccin')}}"> Retour Liste</a></p>
@stop


