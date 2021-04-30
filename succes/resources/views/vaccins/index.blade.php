@extends('base')
@section('title')
<title>Vaccins</title>
@stop
@section('content')
  <div class="text-center mt-4">
	    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif

        @if($vaccins->count()>0)
            <ul>
               @foreach($vaccins as $vaccin)
	         <!--utilisation des routes -->
	         <li><a href="{{ 
	        	route('vaccins.show',
                $vaccin->id)}}">{{ $vaccin->campagne}}-{{ $vaccin->datedevaccination}}-{{$vaccin->intitulevaccin}}</a></li>
		
	        @endforeach
	    
	
	        </ul>
	   <div>
		 {{$vaccins->links()}}
	    </div>
       @else
	     <div class="alert alert-success">
	        <p>Aucun suivi de Vaccin e cours !!! </p>
      	</div>
	   @endif

<br>
    <p class="text-center"><a href="{{route('vaccins.create')}}">Enregister un Vaccin</a>
	 |
	<a href="{{route('recap_vaccin')}}">Recap Vaccin</a>

    </p>
    <p><a href="/OutilsCampagne">Menu Campagne</a></p>
</div>
@stop