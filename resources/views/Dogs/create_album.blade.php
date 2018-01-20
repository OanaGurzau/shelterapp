 @extends('layouts.app')

@section ('content') 

<div> 
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Adauga poza de album la un caine</div>

<div class="panel-body">
        {!!Form::open(['action' => 'DogsAlbumsController@store','method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
                {{--  {{Form::bsText('name','',['placeholder' => 'Nume album'])}}
                {{Form::bsText('breed','',['placeholder' => 'Rasa'])}}
                {{Form::bsText('color','',['placeholder' => 'Culoare'])}}
                {{Form::bsText('microchip','',['placeholder' => 'Numar Microcip'])}}
                {{Form::bsTextArea('description','',['placeholder' => 'Descriere album'])}}
                {{Form::bsText('notes','',['placeholder' => 'Informatii Extra'])}}
                {{Form::label('sex', 'Alege sexul')}}
                {{Form::select('sex', array('M' => 'Male', 'F' => 'Female'))}}
                <br><br>
                {{Form::label('birthdate', 'Zi nastere')}}
                {{Form::date('birthdate', \Carbon\Carbon::now())}}
                <br><br>
                {{Form::label('join_shelter_date', 'Prima zi in adapost')}}
                {{Form::date('join_shelter_date', \Carbon\Carbon::now())}}
                <br><br>  --}}
                
                {{Form::select('dog_id', $dogsView, null, ['class' => 'form-control', 'id' => 'id', 'placeholder' => 'Ataseaza poza de album la un caine existent'])}}
<br>
                {{Form::label('cover_image', 'Imagine album')}}
                {{Form::bsfile('cover_image')}}
                <br>
                {{Form::bsSubmit('Submit', ['class'=> 'btn btn-primary'])}}
              {!! Form::close() !!}
</div>
        </div>
    </div>
</div>




@endsection 