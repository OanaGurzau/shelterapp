 @extends('layouts.app')

@section ('content')

<div> 
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Adauga un album</div>

<div class="panel-body">
        {!!Form::open(['action' => 'DogsAlbumsController@store','method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
                {{Form::bsText('name','',['placeholder' => 'Nume album'])}}
                {{Form::bsTextArea('description','',['placeholder' => 'Descriere album'])}}
                {{Form::bsfile('cover_image')}}
                {{Form::bsSubmit('Submit', ['class'=> 'btn btn-primary'])}}
              {!! Form::close() !!}
</div>
        </div>
    </div>
</div>
@endsection 