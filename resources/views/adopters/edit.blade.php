@extends('layouts.app')

@section('content')


<div> 
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Editeaza Adoptator <a href="/adopter" class="pull-right btn btn-primary btn-xs">Inapoi la adoptatori</a></div>
    
    
    <div class="panel-body">
            {!!Form::open(['action' => ['AdoptersController@update', $adopter->id], 'method' => 'POST'])!!}
                    {{Form::bsText('name',$adopter->name,['placeholder' => 'Nume si Prenume'])}}
                    {{Form::bsText('address', $adopter->address, ['placeholder' => 'Adresa'])}}
                    {{Form::bsText('county', $adopter->county, ['placeholder' => 'Judet'])}}
                    {{Form::bsText('city', $adopter->city, ['placeholder' => 'Oras'])}}
                    {{Form::bsText('phone_number', $adopter->phone_number, ['placeholder' => 'Nr Telefon'])}}
                    {{Form::bsText('email', $adopter->email, ['placeholder' => 'Email'])}}
                    {{Form::label('last_home_visit', 'Data ultimei verificari a domiciliului: ')}}
                    {{Form::date('last_home_visit', $adopter->last_home_visit, [\Carbon\Carbon::now()])}}
                    <br><br>
                    {{Form::bsText('info', $adopter->info, ['placeholder' => 'Info'])}}
                    {{Form::hidden('_method', 'PUT')}}
                    {{Form::bsSubmit('submit')}}
            {!! Form::close() !!}
    </div>
            </div>
        </div>
    </div>
    @endsection