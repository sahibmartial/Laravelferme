<h2>Editer Employer #{{ $employes->id}}</h2>
<form action="{{route('employes.update',$employes)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	<input type="text" name="name" placeholder="Entrez nom" value="{{ old('name')?? $employes->name}}">
	
	{!! $errors->first('name','<span class="error-msg">:message</span>') !!}
   <br>
	<input type="email" name="email" cols="20" rows="10" placeholder="Email" value=" {{old('email')?? $employes->email}}">
	{!! $errors->first('email','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Editer Employer">
</form>