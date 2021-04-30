@extends('base')
@section('title')
<title>VACCIN</title>
@stop

@section('content')
<div class="text-center mt-4">
@include('shared.vaccin_edit')
<hr>
<p><a href="{{route('vaccin')}}">Listing Vaccin</a></p>
</div>
@stop