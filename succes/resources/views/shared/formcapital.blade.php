<h2>Apport</h2>
<form action="{{route('ajoutCapital')}}" method="POST">
	{{ csrf_field() }}
	<input type="text" name="campagne" placeholder="Entrez nom campagne " value={{ old('campagne') }}>
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="integer" name="apport" placeholder="Entrez votre Apport" value="">
	{!! $errors->first('apport','<span class="error-msg">:message</span>') !!}
	<!--
	<br>
  <input type="text" name="status" placeholder="" value="EN COURS">
	{!! $errors->first('status','<span class="error-msg">:message</span>') !!}

	<br>
  	<textarea name="obs" placeholder="RAS"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	-->

	<br>
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
	<input type="submit" value="Ajouter Apport">
	
</form>