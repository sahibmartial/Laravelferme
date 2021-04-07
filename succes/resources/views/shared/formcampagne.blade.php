<h2>Creer une campagne</h2>
<form action="{{route('campagnes.store')}}" method="POST">
	{{ csrf_field() }}
	<input type="text" name="title" placeholder="Entrez nom campagne " value={{ old('title') }}>
	{!! $errors->first('title','<span class="error-msg">:message</span>') !!}
  <br>
   <input type="integer" name="budget" placeholder="Entrez le budget">
	{!! $errors->first('budget','<span class="error-msg">:message</span>') !!}
	<br>
  <input type="text" name="status" placeholder="" value="EN COURS">
	{!! $errors->first('status','<span class="error-msg">:message</span>') !!}
	<br>
  	<textarea name="obs" placeholder="RAS"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Creer">
	
</form>

