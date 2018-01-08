@extends('layouts.app')

@section('content')

<div> 
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Adauga Istoric Medical<a href="/medicalrecord" class="pull-right btn btn-primary btn-xs">Inapoi la istoric medical</a></div>
    
    
    <div class="panel-body">
            {!!Form::open(['action' => 'MedicalRecordsController@store','method' => 'POST'])!!}
            
                    {{Form::label('rabies_vaccine_date', 'Data ultimului vaccin de rabie')}}
                    {{Form::date('rabies_vaccine_date', \Carbon\Carbon::now())}}
                    <div class="pull-right">
                    {{Form::label('next_rabies_vaccine_date', 'Data urmatorului vaccin de rabie: ')}}
                    {{Form::date('next_rabies_vaccine_date', \Carbon\Carbon::now())}}
                    </div>
                    <br><br>                
                    {{Form::label('deworming_date', 'Data ultimei deparazitari')}}
                    {{Form::date('deworming_date', \Carbon\Carbon::now())}}
                    <div class="pull-right">
                    {{Form::label('next_deworming_date', 'Data urmatoarei deparazitari: ')}}
                    {{Form::date('next_deworming_date', \Carbon\Carbon::now())}}
                    </div>
                    <br><br>
                    {{Form::label('sterilized', 'Sterilizat/Castrat')}}
                    {{Form::select('sterilized', array('0' => 'Nu', '1' => 'Da'))}}  
                    {{Form::select('dog_id', $dogsView, null, ['class' => 'form-control', 'id' => 'id', 'placeholder' => 'Alege caine'])}}
                    
                    {{Form::bsSubmit('submit')}}
            {!! Form::close() !!}
    </div>
            </div>
        </div>
    </div>

@endsection