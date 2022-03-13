<form name="myForm" action=" {{route('get_billan_achats_enCours')}}" method="POST">
	{{ csrf_field() }}
   <div class="form-group">

                       <!--     {{ Form::label('campagne', 'Name Campagne:') }}
                            <br>
                           <input type="text" name="campagne" placeholder="campagne1"
                           @error('campagne') is-invalid @enderror" name="campagne" value="{{ old('campagne') }}" required autocomplete="campagne" autofocus>
                           @error('campagne')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror -->
         <select class="form-select" aria-label="Default select example" name="campagne" id="campagne">
            <option selected>CampagneX</option>
               @foreach ($campagnes as $campagne)
                   <option value="{{ $campagne->intitule }}">{{ $campagne->intitule }}</option>
               @endforeach

           </select>


    </div>

	<input type="submit" onclick="validateForm()" value="Bilan ">
</form>

<script>
function validateForm() {

let errors=[];

let nom = document.forms["myForm"]["campagne"].value;

if (nom=='CampagneX') {

	errors.push('Campagne manquante.\n');
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
