@extends('layouts.app')

@section('content')


<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/ro_RO/sdk.js#xfbml=1&version=v2.11';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="container">
<h1>Contact</h1>
<div class="row">
    <div class="col-8">

{!! Form::open(['url' => 'contact/submit']) !!}
    <div class="form-group">
        {{Form::label('name', 'Nume')}}
        {{Form::text('name', '', ['class' => 'form-control', 'placeholder' => 'Nume complet'])}}
    </div>
    <div class="form-group">
        {{Form::label('email', 'Adresa E-mail')}}
        {{Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'examplu@gmail.com'])}}
    </div>
    <div class="form-group">
        {{Form::label('phone', 'Numar Telefom')}}
        {{Form::text('phone', '', ['class' => 'form-control', 'placeholder' => 'Numar telefom'])}}
    </div>

    <div class="form-group">
        {{Form::label('message', 'Informatii despre dvs')}}
        {{Form::textarea('message', '', ['class' => 'form-control', 'placeholder' => 'De ce doriti acest caine'])}}
    </div>
    {{Form::select('dog_id', $albumView, null, ['class' => 'form-control', 'dog_id' => 'id', 'placeholder' => 'Alege cainele dorit'])}}
    <br>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}

{!! Form::close() !!}
</div>
<div class="col-4">
    <div class="fb-page" data-href="https://www.facebook.com/petstogorradutermure/?ref=br_rs" data-tabs="timeline" data-width="400" data-height="200" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/petstogorradutermure/?ref=br_rs" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/petstogorradutermure/?ref=br_rs">PETS to GO</a></blockquote></div>

</div>
</div>
</div>
@endsection