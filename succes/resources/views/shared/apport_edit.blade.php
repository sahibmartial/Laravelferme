<h2>Editer Apport #{{ $apports->id}}</h2>
<form action="{{route('apports.update',$apports)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	<input type="text" name="campagne" placeholder="Entrez le nom de la campagne" value="{{ old('campagne')?? $apports->campagne}}">
	
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="integer" name="budget" placeholder="Entrez votre budget" value="{{ old('budget')?? $apports->budget}}">
	
	{!! $errors->first('budget','<span class="error-msg">:message</span>') !!}
  <br>
	<!--
  	<textarea name="obs" placeholder="RAS" value=" {{old('obs')?? $apports->obs}}"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
    -->
    <div>
		<select name="obs" class="custom-select">
		<option selected>Origine des Apports</option>
		<option value="Apport issu de Martial">Apport issu de Martial</option>
		<option value="Apport issu de Edmond">Apport issu de Edmond</option>
		<option value="Apport issu des Ventes">Apport issu des Ventes</option>
		<option value="Autres">Autres</option>
	</select>

	</div>
	<br>
	<input type="submit" value="Modifiez ">
</form>