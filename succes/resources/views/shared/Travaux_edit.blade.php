<h2>Modifiez Materiel#{{ $materiel['id']}}</h2>
<form action="{{route('travauxconstruction.update',$materiel)}}" method="POST">
	{{ csrf_field() }}
	{{ method_field('PUT')}}	
    <div>
    {{ Form::label('Date', 'Date:') }}
    <input type="date" name="date" value="{{ old('date')?? $materiel->date }}">
	{!! $errors->first('date','<span class="error-msg">:message</span>') !!}
    </div>
    <div> 
    {{ Form::label('Libelle', 'Libelle:') }}    

     <input type="text" name="materiel" id="materiel"  value="{{ old('materiel')?? $materiel->materiel }}"  onKeyUp="check(this)" onChange="check(this)">
     {!! $errors->first('materiel','<span class="error-msg" role="alert">:message</span>') !!}
     </div>

     <div>
    {{ Form::label('Quantite', 'Quantite:') }}
      <input type="number" name="quantite" value="{{ old('quantite') ??  $materiel->quantite }}">
       {!! $errors->first('quantite','<span class="error-msg" role="alert">:message</span>') !!}
     </div>
    <div>
     {{ Form::label('Prix', 'Prix Unit:') }}
    <input type="number" name="priceUnitaire" value="{{ old('PriceUnitaire') ?? $materiel->PriceUnitaire}}">
      {!! $errors->first('priceUnitaire','<span class="error-msg" role="alert" >:message</span>') !!}
    </div>
	
    <div>
    {{ Form::label('Obs', 'Observation:') }}
  	<textarea name="obs" placeholder="RAS" value="">{{ old('obs')?? $materiel->obs }}</textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Modifiez">
    </div>	
</form>