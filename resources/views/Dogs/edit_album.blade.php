 @extends('layouts.app')

@section ('content')

<div> 
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Editeaza imaginea albumului</div>

<div class="panel-body">
        {!!Form::open(['action' => ['DogsAlbumsController@update', $album->id], 'method' => 'PATCH', 'enctype' => 'multipart/form-data'])!!}
                {{Form::label('cover_image', 'Editeaza imaginea albumului')}}
                <br><br>
                {{Form::bsfile('cover_image')}}
                <br>
                <br>
                {{Form::bsSubmit('Submit', ['class'=> 'btn btn-primary'])}}
              {!! Form::close() !!}
</div>
        </div>
    </div>
</div>
@endsection 