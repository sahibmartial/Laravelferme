@extends('base')
@section('title')
<title>BILAN</title>
@stop
@section('content')
@include('shared.bilan_edit')
{{--<p><a href="{{ route('bilans.edit', $bilans)}}">Modifier Bilan</a>--}}
</p>

<p class="text-center"><a href="{{route('home')}}">Accueil</a></p>


@stop