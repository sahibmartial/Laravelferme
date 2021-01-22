@extends('base')
@section('title')
<title>Modifier-Password</title>
@endsection
@section('content')
@if (Session::has('success'))

            <div class="alert alert-success text-center">

                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>

                <p>{{ Session::get('success') }}</p>

            </div>

@endif
<h2 class="text-center"></h2>
<form class="text-center" action="{{route('updatepasswd')}}" method="POST">
	{{ csrf_field() }}
   <div>
    <h2>Modifier Mot de Passe:</h2><br>

                            {{ Form::label('Email', 'Mail:') }}
                            <br>
                           <input type="email" name="email" placeholder="Email"
                           @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                           @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>


                            {{ Form::label('AncienPassword', 'mot2passe Actuel:') }}
                            <br>
                           <input type="password" name="oldpasswd" placeholder="Actuel password"
                           @error('oldpasswd') is-invalid @enderror" name="oldpasswd" value="{{ old('oldpasswd') }}" required autocomplete="oldpasswd" autofocus>
                           @error('oldpasswd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>

                                {{ Form::label('NewPassword', 'Nouveau Password:') }}
                            <br>
                           <input type="password" name="password" placeholder="new password"
                           @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
                           @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <br>

                                 {{ Form::label('ConfirmPassword', 'Confirmez Password:') }}
                            <br>
                           <input type="password" name="confirm" placeholder="confirm"
                           @error('confirm') is-invalid @enderror" name="confirm" value="{{ old('confirm') }}" required autocomplete="confirm" autofocus>
                           @error('confirm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

    </div>
	<br>
	<input type="submit" value="Mettre à jour">
</form>
<hr>
<p class="text-center"><a href="/ferme"> Retour Board</a></p>



@stop