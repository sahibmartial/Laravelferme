@extends('layout.addmorealiments')
<?php 
  $result = array();
 use App\Http\Controllers\CampagneController;
//echo "string";
$cam= new CampagneController();
 $id=$cam->getCampagneenCours();
  //$var= $id->toJson();
 // dump($id);
 for ($i=0; $i <$id->count(); $i++) { 
 	//dump($id[$i]->id);
 	 $result[]=$id[$i]->intitule;
 }
//dump( $result);
  ?>
@section('title')
<title>ACHATS-POUSSINS</title>
@endsection
@section('contenu')
  <div class="suggestions">
        <ul></ul>
    </div>
<script type="text/javascript">	

	//var formValid = document.getElementById('bouton_envoi');

 // var code = document.getElementById('campagne');
//var base= ['log', 'login', 'logon', 'logout', 'logoff', 'logged'];

	var list_cmd_ra = '<?php echo json_encode($result);?>';
     //  var list_array=JSON.parse(list_cmd_ra);
      // const input = document.querySelector('#campagne');
       //const suggestions = document.querySelector('.suggestions ul');
       // alert();  
function check(field) {
  var name = field.value;
  var l = name.length;
  var idx = list_cmd_ra.indexOf(name);
  if(idx == -1) {
    var tempo = list_cmd_ra.filter(function(x) {
      return x.substr(0, l) == name;
    });
    if(tempo.length != 1) return;
    name = tempo[0];  
    field.value = name;
  }
  var content = name + " trouvé.";
  //alert(content);
  document.getElementById("campagne").innerHTML=content;
}

</script>
<h1>Achat de poussins</h1>
<form id="completion_form" action="{{route('poussins.store')}}" method="POST">
	{{ csrf_field() }}
	{{--<input type="text" name="campagne_id"  placeholder="Entrez ID " value={{ old('campagne_id') }} >
     {!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
    <br>--}}
	<input type="text" name="campagne" id="campagne" placeholder="Entrez nom campagne " onKeyUp="check(this)" onChange="check(this)">
     {!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
    <br>
	<input type="number" name="quantite" placeholder="Entrez la quantite " value={{ old('quantite') }}>
	{!! $errors->first('quantite','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="number" name="priceUnitaire" placeholder="Prix Unitaire " value={{ old('priceUnitaire') }}>
	{!! $errors->first('priceUnitaire','<span class="error-msg">:message</span>') !!}
  <br>
  <input type="text" name="fournisseur" placeholder="Fournisseur">
	{!! $errors->first('fournisseur','<span class="error-msg">:message</span>') !!}
	<br>
	<textarea name="obs" placeholder="RAS"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
	<br>
	<input type="submit"  onclick="text()" value="Enregister quantite" id="bouton_envoi">
</form>
<br>
<p><a href="{{route('poussins.index')}}">Lister achats poussins</a></p>
@stop

@section('retour')
<p><a href="/achats"> Retour Achats</a></p>
@endsection
@section('footer')
@include('layout.partials.footer')
@stop