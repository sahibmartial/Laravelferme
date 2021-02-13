@extends('layouts.app')
@section('title')
<title>Reset-Password</title>
@endsection
@section('content')
@if (Session::has('success'))

            <div class="alert alert-success text-center">

                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

                <p>{{ Session::get('success') }}</p>

            </div>

@endif
@stop