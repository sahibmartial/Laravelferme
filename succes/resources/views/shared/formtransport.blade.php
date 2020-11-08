<h2>Frais Transport</h2>
<form action="{{route('transports.store')}}" method="POST">
	{{ csrf_field() }}

	{{--<input type="text" name="campagne_id" placeholder="Entrez ID " value={{ old('campagne_id') }}>
     {!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
  <br>--}}
<div>
  {{ Form::label('Date', 'Date:') }}
                            <br>
                           <input type="date" name="date_achat" placeholder=""
                           @error('date_achat') is-invalid @enderror" name="date_achat" value="{{ old('date_achat') }}" required autocomplete="date_achat" autofocus>
                           @error('date_achat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
	<input type="text" name="campagne" placeholder="Entrez nom campagne " value={{ old('campagne') }}>
     {!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="number" name="montant" placeholder="Montant " value={{ old('montant') }}>
	{!! $errors->first('montant','<span class="error-msg">:message</span>') !!}
  <br>
  	<textarea name="obs" placeholder="RAS"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Enregister frais transport">
</form>
<br>
<br>
<div><a href="{{route('transports.index')}}">Lister Frais</a></div>
<br>