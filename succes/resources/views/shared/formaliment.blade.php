<h1>Achat Aliments</h1>
<form action="{{route('aliments.store')}}" method="POST">
	{{ csrf_field() }}
	{{--<input type="text" name="campagne_id" placeholder="Entrez ID " value={{ old('campagne_id') }}>
     {!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
    <br>--}}
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
	<input type="text" name="libelle" placeholder="Entrez libelle " value={{ old('libelle') }}>
	{!! $errors->first('libelle','<span class="error-msg">:message</span>') !!}
	<br>
  <input type="number" name="quantite" placeholder="Quantite " value={{ old('quantite') }}>
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="number" name="priceUnitaire" placeholder="Prix Unitaire " value={{ old('priceUnitaire') }}>
	{!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="text" name="fournisseur" placeholder="Fournisseur" value={{ old('fournisseur') }}>
	{!! $errors->first('fournisseur','<span class="error-msg">:message</span>') !!}
  <br>
  	<textarea name="obs" placeholder="RAS"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Enregister achat aliment">
</form>
<p><a href="{{route('aliments.index')}}">Lister Aliments</a></p>