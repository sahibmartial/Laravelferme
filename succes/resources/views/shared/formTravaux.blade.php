<div class="text-center">
<form id="completion_form" action="{{route('travauxconstruction.store')}}" method="POST">
  {{ csrf_field() }}
    <div>
  {{ Form::label('Date', 'Date:') }}
                           <input type="date" name="date_achat" placeholder=""
                           @error('date_achat') is-invalid @enderror" name="date_achat" value="{{ old('date_achat') }}" required autocomplete="date_achat" autofocus>
                           @error('date_achat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>
    <div> 
    {{ Form::label('Libelle', 'Libelle:') }}    

  <input type="text" name="materiel" id="materiel" placeholder="Entrez nom materiel" onKeyUp="check(this)" onChange="check(this)">
     {!! $errors->first('materiel','<span class="error-msg" role="alert">:message</span>') !!}
     </div>
    <div>
    {{ Form::label('Quantite', 'Quantite:') }}
  <input type="number" name="quantite" placeholder="Entrez la quantite " value={{ old('quantite') }}>
  {!! $errors->first('quantite','<span class="error-msg" role="alert">:message</span>') !!}
  </div>
  <div>
  {{ Form::label('Prix', 'Prix Unit:') }}
    <input type="number" name="priceUnitaire" placeholder="Prix Unitaire " value={{ old('priceUnitaire') }}>
  {!! $errors->first('priceUnitaire','<span class="error-msg" role="alert" >:message</span>') !!}
  </div>
  <div>
  {{ Form::label('Obs', 'Observation:') }}
  <textarea name="obs" placeholder="RAS">{{old('obs')}}</textarea>
  {!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
  </div>
  <br>
  <input type="submit"  onclick="text()" value="Enregister" id="bouton_envoi">
</form>
<br>
<p><a href="{{route('travauxconstruction.index')}}">Lister Materiels</a></p>
</div>