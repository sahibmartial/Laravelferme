@extends('base')
@section('title')
<title>VENTES</title>
@endsection

@section('content')
<div class="text-center mt-4">
     @if ($message = Session::get('success'))
     <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>

    @endif

    @if($venteimpayes->count()>0)
     
      @include('shared.ventesImpayes')
    @else
    <div class="alert alert-success">
       <p>Aucune Vente impayée  Enregistree !!! </p>

    </div>
    @endif

    <br>
    <p><a href="/OutilsCampagne">Menu Campagne</a></p>
</div>
@stop