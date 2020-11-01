<h2>Register Employe</h2>
<form action="{{route('employes.store')}}" method="POST">
	{{ csrf_field() }}
	{{ Form::label('name', 'Name:') }}
	<input type="text" name="name" placeholder="Entrez nom employer" value={{ old('nom') }}>
	{!! $errors->first('name','<span class="error-msg">:message</span>') !!}
  <br>
  {{ Form::label('email', 'E-Mail') }}
  <input type="email" name="email" placeholder="Email" value="">
	{!! $errors->first('email','<span class="error-msg">:message</span>') !!}
	<br>
	 {{  Form::label('contact', 'Contact: ')  }}	
  	 {{ Form::text('contact', 'xx-yy-zz') }}
  	 {!! $errors->first('contact','<span class="error-msg">:message</span>') !!}
    <br>
	 {{  Form::label('genre', 'Genre: ')  }}	
  	 {{ Form::select('genre', array('M' => 'Male', 'F' => 'Female'), 'M')}}

  	  {!! $errors->first('genre','<span class="error-msg">:message</span>') !!}
    <br>

	<input type="submit" value="Register">
</form>