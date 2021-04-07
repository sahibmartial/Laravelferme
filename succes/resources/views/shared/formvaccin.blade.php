<h2>SuiviVaccin</h2>
<form action="{{route('vaccinformvalidation')}}" method="POST">
	{{ csrf_field() }}
	<input type="text" name="campagne" placeholder="Entrez nom campagne " value={{ old('campagne') }}>
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="date" name="datevaccination">
	{!! $errors->first('datevaccination','<span class="error-msg">:message</span>') !!}
	<br>
  <div>                                                                                     
		<select name="intitulevaccin[]" class="select" multiple>
		<option selected>Choisir Intitule</option>
		<option value="Antibiotique">Antibiotiques</option>
		<option value="Vitamines">Vitamines</option>
		<option value="Vaccin">Vaccins</option>
		<option value="Anticoccidien">Anticoccidiens</option>
		<option value="Maladies Respiratoires">Maladies Respiratoires</option>
	</select>
	</div>	
	<br>
  	<textarea name="obs" placeholder="RAS"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Validez">
	
</form>