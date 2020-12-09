@extends('layout.addmorealiments')
@section('title')
<title>Pertes-OneCampaign</title>
@endsection
@section('contenu')
<h2> Get All losing</h2>
<form action=" {{route('show_all_losing')}}" method="POST">
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
	<input type="submit" value="Soumettre">
</form>
{{--$request->campagne--}}

{{--<p><a href="{{route('pertes.index')}}">Listing pertes</a></p>--}}
@stop
<br>
@section('retour')
<p><a href="/achats"> Retour Achats</a></p>
@endsection

@section('footer')
@include('layout.partials.footer')
@stop