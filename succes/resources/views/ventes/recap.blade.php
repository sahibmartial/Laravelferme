@extends('base')
@section('title')
<title>Vente-campagne-en-cours</title>
@endsection
@section('content')
<div class="container">
    <h6 class="text-center">Vente en Cours </h6>
    @if ($message = Session::get('success'))
       <div class="alert alert-success">
           <p>{{ $message }}</p>
      </div>
    @endif
    <form class="text-center mb-2" action="{{route('recap_vente_show')}}" method="POST">
        {{ csrf_field() }}

        <div class="form-group">
            <select class="form-select mb-2" aria-label="Default select example" name="campagne" id="campagne">
                <option selected>CampagneX</option>
                   @foreach ($campagnes as $campagne)
                       <option value="{{ $campagne->intitule }}">{{ $campagne->intitule }}</option>
                   @endforeach

           </select>

        </div>

        <input type="submit"  value="Soumettre" class="btn btn-lg btn-success">

    </form>

</div>


{{--<p><a href="{{route('pertes.index')}}">Listing pertes</a></p>--}}
<hr>
<p class="text-center"><a href="/ventes"> Listing Vente</a></p>
@stop


