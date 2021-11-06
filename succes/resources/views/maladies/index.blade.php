@extends('base')
@section('title')
   <title>CAS-MALADIE</title>
@endsection

@section('content') 
    <div class="container text-center">
    	@if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        
        @if($maladies->count()>0)
                 @foreach($maladies as $maladie)
                 <li><a href="{{ 
		            route('maladies.show',
	               	$maladie->id)}}">{{ $maladie->campagne}}--{{$maladie->date}}--{{$maladie->symptomes}}</a></li>
              
                @endforeach
                <div>
                {{ $maladies->links() }}
                </div>
        @else
            <div class="alert alert-success">
               <p>Aucun Enregistrement  disponible !!! </p>
            </div>

        @endif
         <p><a href="{{route('maladies.create')}}">Enregister une maladie </a></p>
    </div>

    <p><a href="/OutilsCampagne"> Retour </a></p>
@stop