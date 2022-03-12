<h2>Frais Transport</h2>
<form name="myForm" action="{{route('transports.store')}}" method="POST">
	{{ csrf_field() }}

	{{--<input type="text" name="campagne_id" placeholder="Entrez ID " value={{ old('campagne_id') }}>
     {!! $errors->first('campagne_id','<span class="error-msg">:message</span>') !!}
  <br>--}}
<div class="form-group">
   {{ Form::label('Date', 'Date:') }}
    <input type="date" name="date_achat" placeholder=""
        @error('date_achat') is-invalid @enderror" name="date_achat"
        value="{{ old('date_achat') }}" required class="form-control">
            @error('date_achat')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                          </span>
            @enderror

  </div>
  <div class="form-group">
  <!-- {{ Form::label('Campagne', 'Campagne:') }}
  <input type="text" name="campagne" placeholder="Campagne"
  value="{{old('campagne') }}" class="form-control">
    {!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}-->
     <select class="form-select" aria-label="Default select example" name="campagne" id="campagne">
            <option selected>CampagneX</option>
               @foreach ($campagnes as $campagne)
                   <option value="{{ $campagne->intitule }}">{{ $campagne->intitule }}</option>
               @endforeach

           </select>

  </div>
	<div class="form-group">
  {{ Form::label('Montant', 'Montant:') }}
  <input type="number" name="montant" placeholder="Montant "
   value="{{old('montant') }}" class="form-control">
	{!! $errors->first('montant','<span class="error-msg">:message</span>') !!}
  </div>
  <div class="form-group">
  {{ Form::label('Obs', 'Observations:') }}
  <textarea name="obs" placeholder="RAS" class="form-control"></textarea>
	{!! $errors->first('obs','<span class="error-msg">:message</span>') !!}
  </div>
  <button type="submit" onclick="validateForm()" class="btn btn-success">Enregistrer Transport</button>
	<!--<input type="submit" value="Enregister frais transport">-->
</form>
<br>
<br>
<div><a href="{{route('transports.index')}}">Lister Frais</a></div>
<br>
<script>
function validateForm() {

let errors=[];
let date_achat = document.forms["myForm"]["date_achat"].value;
let nom = document.forms["myForm"]["campagne"].value;
let montant = document.forms["myForm"]["montant"].value;


if (!date_achat.length >0) {

	errors.push('Date manquante.\n');
}
if (nom=='CampagneX') {

	errors.push('Campagne manquante.\n');
}
if (!montant.length >0) {

	errors.push('Montant manquante.\n');
}


if (errors.length>0) {
	event.preventDefault();
	alert(errors)
}
//console.log("hello")
 /* let x = document.forms["myForm"]["fname"].value;
  if (x == "") {
    alert("Name must be filled out");
    return false;
  }*/
}
</script>
