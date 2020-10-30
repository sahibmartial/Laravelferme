
<h2>Editer Vente #{{ $ventes->id}}</h2>
<form action="{{route('ventes.update',$ventes)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}
	<input type="text" name="campagne_id" placeholder="Entrez ID" value="{{ old('campagne_id')?? $ventes->campagne_id}}">
	{!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
   <br>
	<input type="text" name="campagne" cols="20" rows="10" placeholder="Intitule Campagne" value=" {{old('campagne')?? $ventes->campagne}}">
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="number" name="quantite" cols="20" rows="10" placeholder="nombre de poulets vendus" value=" {{old('quantite')?? $ventes->quantite}}">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="number" name="priceUnitaire" cols="20" rows="10" placeholder="Prix Unitaitre" value=" {{old('priceUnitaire')?? $ventes->priceUnitaire}}">
	{!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
	 <br>
	<input type="text" name="acheteur" cols="20" rows="10" placeholder="Type Acheteur" value=" {{old('acheteur')?? $ventes->acheteur}}">
	{!! $errors->first('acheteur','<span class="error-msg">:message</span>') !!}
	 <br>
	<input type="text" name="contact" cols="20" rows="10" placeholder="uu-xx-yy-zz" value=" {{old('contact')?? $ventes->contact}}">
	{!! $errors->first('contact','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="text" name="events" cols="20" rows="10" placeholder="type event" value=" {{old('events')?? $ventes->events}}">
	{!! $errors->first('events','<span class="error-msg">:message</span>') !!}
	<br>
	<textarea name="obs" placeholder="RAS"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Editer Vente">
</form>