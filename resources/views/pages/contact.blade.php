@extends('layouts.app')

@section('content')
<div class="container">
<h1>Contact</h1>

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
@endsection