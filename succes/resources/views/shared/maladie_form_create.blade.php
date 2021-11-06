<h4>Renseigner Maladie </h4>
                <form name="myForm" action="{{route('maladies.store')}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                    {{ Form::label('Date', 'Date:') }}
                    <input type="date" name="date"  placeholder="Sairsir >Date " value="" class="form-control">
                    {!! $errors->first('date','<span class="error-msg">:message</span>') !!}

                    </div>
                    <div class="form-group">
                    {{ Form::label('Campagne', 'Campagne:') }}
                    <input type="text" name="campagne" id="campagne" 
                    placeholder="Entrez nom campagne" value="{{ old('campagne') }}" class="form-control">
                    {!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
                    </div>

                    
                    <div class="form-group">
                    {{  Form::label('symptomes', 'Symtomes: ')  }}
                    <textarea name="sympt" placeholder="RAS" class="form-control"></textarea>
                    {!! $errors->first('sympt','<span class="error-msg">:message</span>') !!}
                    </div>

                    <div class="form-group">
                    {{  Form::label('traitement', 'Traitement: ')  }}
                    <textarea name="treat" placeholder="RAS" class="form-control"></textarea>
                    {!! $errors->first('treat','<span class="error-msg">:message</span>') !!}
                    </div>
                    
                    <!--<input type="submit" value="Enregister masse" class="btn btn-success">-->
                    <button type="submit" onclick="validateForm()" class="btn btn-success">Enregister maladie</button>
                </form>
<br>
     <p><a href="{{route('maladies.index')}}">Listing Maladie</a></p>
<script>
        function validateForm() {

        let errors=[];

        let nom = document.forms["myForm"]["campagne"].value;
        let datemal = document.forms["myForm"]["date"].value;
  
        let trait = document.forms["myForm"]["treat"].value;
        let sympt = document.forms["myForm"]["sympt"].value;


        if (!nom.length >0) {
            
            errors.push('Campagne manquante.\n');
        }
        if (!datemal.length >0) {
            
            errors.push('Date manquante.\n');
        }


        if (!trait.length >0) {
            
            errors.push('Traitement manquant.\n');
        }
        if (!sympt.length >0) {
            
            errors.push('Symptomes manquante.\n');
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