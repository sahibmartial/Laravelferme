<h2>Modifiez Vaccin#{{ $suivi->id}}</h2>
<form action="{{route('vaccins.update',$suivi)}}" method="POST">
	{{ csrf_field() }}
	{{ method_field('PUT')}}
	<input type="text" name="campagne_id" placeholder="Entrez ID" value="{{ old('campagne_id')?? $suivi->campagne_id}}" >
	{!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="text" name="campagne" placeholder="Entrez nom campagne " value="{{ old('campagne')?? $suivi->campagne }}">
	
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="date" name="datevaccination" value="{{ old('datevaccination')?? $suivi->datedevaccination }}">
	{!! $errors->first('datevaccination','<span class="error-msg">:message</span>') !!}
	<br>
  <div>                                                                                     
		<select name="intitulevaccin" class="select">
		<option selected>Actions</option>
		<option value="Arrivée des poussins">Arrivée des poussins</option>
		<option value="Antibiotique">Antibiotiques</option>
		<option value="Vitamines">Vitamines</option>
		<option value="Vaccin">Vaccins</option>
		<option value="Anticoccidien">Anticoccidiens</option>
		<option value="Maladies Respiratoires">Maladies Respiratoires</option>
	</select>
	</div>
	<br>
  	<textarea name="obs" placeholder="RAS" value="">{{ old('obs')?? $suivi->obs }}</textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Modifiez">
		
</form>