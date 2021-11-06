@extends('base')
@section('content')
<p><a href="{{route('maladies.index')}}">Accueil</a></p>
<div class="container text-center">
    <h4>Modification Maladie #{{ $maladie->id}}</h4>
    <form name="myForm" action="{{route('maladies.update',$maladie)}}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT')}}
        <div class="form-group">
            {{ Form::label('Date', 'Date:') }}
            <input type="date" name="date" placeholder="Entrez votre date" 
            value="{{ old('date')?? $maladie->date}}" class="form-control">
            {!! $errors->first('date','<span class="error-msg">:message</span>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Campagne', 'Campagne:') }}
            <input type="text" name="campagne" placeholder="Entrez votre titre" 
            value="{{ old('campagne')?? $maladie->campagne}}" class="form-control">
            {!! $errors->first('campagne','<span class="error-msg">:message</span>') !!}
        </div>

        <div class="form-group">
            {{  Form::label('Symptômes', 'Symptômes: ')  }}
            <textarea name="sympt" 
            value="" class="form-control">{{old('sympt')?? $maladie->symptomes}}</textarea>
            {!! $errors->first('sympt','<span class="error-msg">:message</span>') !!}
        </div>

        <div class="form-group">
            {{  Form::label('Traitement', 'Traitements: ')  }}
            <textarea name="treat" placeholder="RAS" 
            value="" class="form-control">{{old('treat')?? $maladie->traitements}}</textarea>
            {!! $errors->first('treat','<span class="error-msg">:message</span>') !!}
        </div>
        <button type="submit" onclick="validateForm()" class="btn btn-block btn-success">Modifiez maladie</button>

    </form>
    
</div>

@stop

<script>
    function validateForm() {
    
    let errors=[];
    
    let nom = document.forms["myForm"]["campagne"].value;
    let datemal = document.forms["myForm"]["date"].value;
    let sympt = document.forms["myForm"]["sympt"].value;
    let trait = document.forms["myForm"]["treat"].value;
   
    
    
    if (!nom.length >0) {
        
        errors.push('Campagne manquante.\n');
    }
    if (!datemal.length >0) {
        
        errors.push('Date manquante.\n');
    }
    
    if (!sympt.length >0) {
        
        errors.push('Symptômes manquant.\n');
    }
    
    if (!trait.length >0) {
        
        errors.push('Traitements manquant.\n');
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