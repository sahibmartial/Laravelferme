@extends('base')
@section('title')
<title>Vaccins-Campagne </title>
@stop

@section('content')
 <div class="text-center mt-4">
     @if ($message = Session::get('success'))
      <div class="alert alert-info">
            <p>{{ $message }}</p>
        </div>

     @endif

     @if($campagnes->count()>0)
          <div class="alert alert-success">
	            <p> campagne  en cours !!! </p>
           </div>

            <ul>
                @foreach($campagnes as $campagne)
          
                  <li><a href="{{URL::to('traitement_listing',['id'=>$campagne->id])}}"> {{$campagne->intitule}} </a></li>
                @endforeach
           </ul>
           <div>
                {{$campagnes->links()}}
            </div>

     @else
	       <div class="alert alert-info">
	            <p>Aucune campagne  en cours !!! </p>
           </div>

     @endif
     <p><a href="/vaccin">Menu Vaccin</a></p>
 </div>
@stop