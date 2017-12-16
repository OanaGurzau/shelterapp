 @extends('layouts.app')

@section ('content')

<div> 
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Adauga poze</div>

<div class="panel-body">
        {!!Form::open(['action' => 'DogsPhotosController@store','method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
                {{Form::bsText('title','',['placeholder' => 'Titlu Poza '])}}
                {{Form::bsTextArea('description','',['placeholder' => 'Descriere poza'])}}
                {{Form::hidden('dog_album_id', $dog_album_id)}}
                {{Form::bsfile('photo')}}
                <br>
                {{Form::bsSubmit('Submit', ['class'=> 'btn btn-primary'])}}
              {!! Form::close() !!}
</div>
        </div>
    </div>
</div>
@endsection 