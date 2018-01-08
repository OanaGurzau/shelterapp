@extends('layouts.app')

@section('content')

<div> 
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Adauga Adoptator<a href="/adopter" class="pull-right btn btn-primary btn-xs">Inapoi la adoptatori</a></div>
    
    
    <div class="panel-body">
            {!!Form::open(['action' => 'AdoptersController@store','method' => 'POST'])!!}
            
                    {{Form::bsText('name','',['placeholder' => 'Nume si Prenume'])}}
                    {{Form::bsText('address', '', ['placeholder' => 'Adresa'])}}
                    {{Form::bsText('county', '', ['placeholder' => 'Judet'])}}
                    {{Form::bsText('city', '', ['placeholder' => 'Oras'])}}
                    {{Form::bsText('phone_number', '', ['placeholder' => 'Nr Telefon'])}}
                    {{Form::bsText('email', '', ['placeholder' => 'Email'])}}
                    {{Form::label('last_home_visit', 'Data ultimei verificari')}}
                    {{Form::date('last_home_visit', \Carbon\Carbon::now())}}
                    <br><br>
                    {{Form::bsText('info', '', ['placeholder' => 'Info'])}}
                    {{Form::bsSubmit('submit')}}
            {!! Form::close() !!}
    </div>
            </div>
        </div>
    </div>

@endsection