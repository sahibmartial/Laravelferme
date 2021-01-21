<div class="text-center mt-4">
	
<h2>Editer Bilan #{{ $bilans->campagne}}</h2>
<form action="{{route('bilans.update',$bilans)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	{{--<input type="text" name="obs" placeholder="Entrez new comment" value="{{ old('obs')?? $bilans->intitule}}">
	
	{!! $errors->first('title','<span class="error-msg">:message</span>') !!}
  <br>
	<input type="text" name="status" cols="20" rows="10" placeholder="Entre le statut" value=" {{old('status')?? $campagnes->status}}">
	{!! $errors->first('status','<span class="error-msg">:message</span>') !!}
	<br>--}}
  	<textarea name="obs" placeholder=" Entez new obs" >{{ old('obs')?? $bilans->obs}}</textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Editer  Bilan">
</form>
	
</div>
