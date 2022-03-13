@extends('base')
@section('title')
<title>Pertes-Campagne</title>
@endsection
@section('content')
<div class="container">
    <h6 class="text-center"> Déclaration pertes poulets</h6>
    <form class="text-center" action=" {{route('show_all_losing')}}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <select class="form-select mb-2" aria-label="Default select example" name="campagne" id="campagne">
                <option selected>CampagneX</option>
                   @foreach ($campagnes as $campagne)
                       <option value="{{ $campagne->intitule }}">{{ $campagne->intitule }}</option>
                   @endforeach

           </select>

        </div>
        <input type="submit" value="Soumettre">
    </form>

</div>






<hr>
<p class="text-center"><a href="/achats"> Retour Achats</a></p>
{{--$request->campagne--}}

{{--<p><a href="{{route('pertes.index')}}">Listing pertes</a></p>--}}
@stop
<br>


