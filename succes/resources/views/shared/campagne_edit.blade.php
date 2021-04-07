<h2>Editer campagne #{{ $campagnes->id}}</h2>
<form action="{{route('campagnes.update',$campagnes)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	<input type="text" name="title" placeholder="Entrez votre titre" value="{{ old('title')?? $campagnes->intitule}}">
	
	{!! $errors->first('title','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="integer" name="budget" placeholder="Entrez votre budget" value="{{ old('budget')?? $campagnes->budget}}">
	
	{!! $errors->first('budget','<span class="error-msg">:message</span>') !!}
  <br>
	<input type="text" name="status" cols="20" rows="10" placeholder="Entre le statut" value=" {{old('status')?? $campagnes->status}}">
	{!! $errors->first('status','<span class="error-msg">:message</span>') !!}
	<br>
  	<textarea name="obs" placeholder="RAS" value=" {{old('obs')?? $campagnes->obs}}"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Editer la campagne">
</form>