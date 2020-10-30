<h2>Masse Moyenne de la campagne </h2>
<form action="{{route('masses.store')}}" method="POST">
	{{ csrf_field() }}
	{{--<input type="text" name="campagne_id"  placeholder="Entrez ID " value={{ old('campagne_id') }} >
     {!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
    <br>--}}
	<input type="text" name="campagne" id="campagne" placeholder="Entrez nom campagne" value={{ old('campagne') }}>
     {!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
    <br>
	<input type="double" name="mean_masse" placeholder="Saisir la masse" value={{ old('mean_masse') }}>
	{!! $errors->first('mean_masse','<span class="error-msg">:message</span>') !!}
  <br>
	<textarea name="obs" placeholder="RAS"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Enregister masse">
</form>
<br>
<p><a href="{{route('masses.index')}}">Lister masse campagne</a></p>