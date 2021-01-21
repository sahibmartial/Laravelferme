@extends('base')
@section('title')
<title>TRANSPORT</title>
@stop

@section('content')
<div class="text-center mt-4">
@include('shared.transportedit')
<hr>
<p><a href="{{route('transports.index')}}">Listing Frais</a></p>
</div>
@stop



