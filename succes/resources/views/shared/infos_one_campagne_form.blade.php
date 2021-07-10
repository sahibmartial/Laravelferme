<form action=" {{route('get_billan_achats_enCours')}}" method="POST">
	{{ csrf_field() }}
   <div>
                            {{ Form::label('campagne', 'Name Campagne:') }}
                            <br>
                           <input type="text" name="campagne" placeholder="campagne1"
                           @error('campagne') is-invalid @enderror" name="campagne" value="{{ old('campagne') }}" required autocomplete="campagne" autofocus>
                           @error('campagne')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>
	<br>
	<input type="submit" value="Bilan ">
</form>