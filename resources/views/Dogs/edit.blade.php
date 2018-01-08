@extends('layouts.app')

@section ('content')

<div> 
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Editeaza un animal</div>

<div class="panel-body">
        {!!Form::open(['action' => ['DogsController@update', $dog->id], 'method' => 'PATCH')!!}
                {{Form::bsText('name',$dog->name, ['placeholder' => 'Nume'])}}
                {{Form::bsText('breed',$dog->breed,['placeholder' => 'Rasa'])}}
                {{Form::bsText('color',$dog->color,['placeholder' => 'Culoare'])}}
                {{Form::bsText('microchip',$dog->microchip,['placeholder' => 'Numar Microcip'])}}
                {{Form::bsTextArea('description',$dog->description,['placeholder' => 'Descriere album'])}}
                {{Form::bsText('notes',$dog->notes,['placeholder' => 'Informatii Extra'])}}
                {{Form::label('sex', 'Alege sexul')}}
                {{Form::select('sex', array('M' => 'Male', 'F' => 'Female'))}}
                <br><br>
                {{Form::label('birthdate', 'Zi nastere')}}
                {{Form::date('birthdate', $dog->birthdate, [\Carbon\Carbon::now()])}}
                <br><br>
                <br>
                {{Form::bsSubmit('Submit', ['class'=> 'btn btn-primary'])}}
              {!! Form::close() !!}
</div>
        </div>
    </div>
</div>
@endsection 