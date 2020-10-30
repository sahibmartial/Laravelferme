@extends('layout.default') 
@section('content')
<h4> Create a New Blog Post </h4>
{{  Form::open( [ 'route' => 'blogposts.store' ] )  }}
<div> {{  Form::label('title', 'Title: ')  }}
  {{  Form::text('title', '', array('class' => 'form-control'))  }} 
</div>
 
<div> 
  {{  Form::label('body', 'Body: ')  }}
  {{  Form::textarea('body', '', array('class' => 'form-control'))  }} 
</div>
  <div>
  	Form::select('size', array('L' => 'Large', 'S' => 'Small'), 'S');
  </div>
<div> 
  {{--Form::submit('Create Post', array('class' => 'btn btn-info'))--}} 
</div>
 
{{--Form::close()--}}
@stop 