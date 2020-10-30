<h2>Cloturer une campagne</h2>

<form action="{{route(cloturecampagne)}}" method="POST">
	{{ csrf_field() }}
	<input type="text" name="title" placeholder="Entrez nom campagne " value={{ old('title') }}>
	{!! $errors->first('title','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Cloturer Campagne">
</form>