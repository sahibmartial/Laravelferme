
<h2>Editer Frais de Transport #{{ $transports->id}}</h2>
<form action="{{route('transports.update',$transports)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	<input type="text" name="campagne_id" placeholder="Entrez ID" value="{{ old('campagne_id')?? $transports->campagne_id}}">
	{!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
   <br>
	<input type="text" name="campagne" cols="20" rows="10" placeholder="Intitule Campagne" value=" {{old('campagne')?? $transports->campagne}}">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="number" name="montant" cols="20" rows="10" placeholder="Frais" value=" {{old('montant')?? $transports->montant}}">
	{!! $errors->first('montant','<span class="error-msg">:message</span>') !!}
	<br>
	<textarea name="obs" placeholder="RAS"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Editer Frais">
</form>