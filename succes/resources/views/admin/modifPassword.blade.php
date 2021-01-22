@extends('base')
@section('title')
<title>Modifier-Password</title>
@endsection
@section('content')
<h2 class="text-center"></h2>
<form class="text-center" action="" method="POST">
	{{ csrf_field() }}
   <div>
                            {{ Form::label('AncienPassword', 'Saisir Nom campagne:') }}
                            <br>
                           <input type="text" name="oldpasswd" placeholder="Ancien pAssword"
                           @error('oldpasswd') is-invalid @enderror" name="oldpasswd" value="{{ old('oldpasswd') }}" required autocomplete="oldpasswd" autofocus>
                           @error('oldpasswd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                {{ Form::label('NewPassword', 'Saisir Nom campagne:') }}
                            <br>
                           <input type="text" name="newpassswd" placeholder="new password"
                           @error('newpassswd') is-invalid @enderror" name="newpassswd" value="{{ old('newpassswd') }}" required autocomplete="newpassswd" autofocus>
                           @error('newpassswd')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
    </div>
	<br>
	<input type="submit" value="Modifier">
</form>
<hr>
<p class="text-center"><a href="/ferme"> Retour Board</a></p>



@stop