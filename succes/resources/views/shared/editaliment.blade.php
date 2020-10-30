
<h2>Editer  Achat Aliment #{{ $aliments->id}}</h2>
<form action="{{route('aliments.update',$aliments)}}" method="POST">
	{{ csrf_field() }}
	<!--<input type="hidden" name="method" value="PUT">-->
	{{ method_field('PUT')}}

	<input type="text" name="campagne_id" placeholder="Entrez ID" value="{{ old('campagne_id')?? $aliments->campagne_id}}">
	{!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
   <br>
	<input type="text" name="campagne" placeholder="Entrez votre titre" value="{{ old('campagne')?? $aliments->campagne}}">
	{!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
   <br>
	<input type="text" name="libelle" cols="20" rows="10" placeholder="libelle" value=" {{old('libelle')?? $aliments->libelle}}">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="number" name="quantite" cols="20" rows="10" placeholder="quantite" value=" {{old('quantite')?? $aliments->quantite}}">
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="number" name="priceUnitaire" cols="20" rows="10" placeholder="priceUnitaire" value=" {{old('priceUnitaire')?? $aliments->priceUnitaire}}">
	{!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="text" name="fournisseur" cols="20" rows="10" placeholder="Fournisseur" value=" {{old('fournisseur')?? $aliments->fournisseur}}">
	{!! $errors->first('fournisseur','<span class="error-msg">:message</span>') !!}
	<br>
	<textarea name="obs" placeholder="RAS"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit" value="Editer Achat Aliment">
</form>