 @extends('layouts.app')

@section ('content')

<div> 
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Editeaza imaginea albumului</div>

<div class="panel-body">
        {!!Form::open(['action' => ['DogsAlbumsController@update', $dogs->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data'])!!}
                {{--  {{Form::bsText('name',$dogs->name, ['placeholder' => 'Nume album'])}}
                {{Form::bsText('breed',$dogs->breed,['placeholder' => 'Rasa'])}}
                {{Form::bsText('color',$dogs->color,['placeholder' => 'Culoare'])}}
                {{Form::bsText('microchip',$dogs->microchip,['placeholder' => 'Numar Microcip'])}}
                {{Form::bsTextArea('description',$dogs->description,['placeholder' => 'Descriere album'])}}
                {{Form::bsText('notes',$dogs->notes,['placeholder' => 'Informatii Extra'])}}
                {{Form::label('sex', 'Alege sexul')}}
                {{Form::select('sex', array('M' => 'Male', 'F' => 'Female'))}}
                <br><br>
                {{Form::label('birthdate', 'Zi nastere')}}
                {{Form::date('birthdate', $dogs->birthdate, [\Carbon\Carbon::now()])}}
                <br><br>
                {{Form::label('join_shelter_date', 'Prima zi in adapost')}}
                {{Form::date('join_shelter_date', $background->join_shelter_date, [\Carbon\Carbon::now()])}}
                <br><br>
  --}}
                {{Form::label('cover_image', 'Editeaza imaginea albumului')}}
                <br><br>
                {{Form::bsfile('cover_image')}}
                <br>
                {{--  {{Form::select('dog_id', $dogsView, null, ['class' => 'form-control', 'id' => 'id', 'placeholder' => 'Ataseaza poza unui caine deja existent'])}}  --}}
                <br>
                {{Form::bsSubmit('Submit', ['class'=> 'btn btn-primary'])}}
              {!! Form::close() !!}
</div>
        </div>
    </div>
</div>
@endsection 