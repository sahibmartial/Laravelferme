<h2>Register Employe</h2>
<form action="{{route('employes.store')}}" method="POST">
	{{ csrf_field() }}
	<input type="text" name="name" placeholder="Entrez nom employer" value={{ old('nom') }}>
	{!! $errors->first('name','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="email" name="email" placeholder="Email" value="">
	{!! $errors->first('email','<span class="error-msg">:message</span>') !!}
	<br>
	 <div>
  	{{ Form::select('size', array('L' => 'Large', 'S' => 'Small'), 'S'); }}
  </div>
	<input type="submit" value="Register">
</form>