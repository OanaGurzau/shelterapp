@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Persoane interesate de adoptie</h1>
    <br>
  @if(count($messages) > 0)
    @foreach($messages as $message)
      <ul class="list-group">            
        <li class="list-group-item"><strong>Nume:</strong> {{$message->name}}</li>       
        <li class="list-group-item"><strong>E-mail:</strong> {{$message->email}}</li>
        <li class="list-group-item"><strong>Numar telefon:</strong> {{$message->phone}}</li>
        <li class="list-group-item"><strong>Mesaj:</strong> {{$message->message}}</li>
        <li class="list-group-item"><strong>Caine dorit:</strong> {{$message->dog_id}}</li>
        <li class="list-group-item clearfix">
            {!!Form::open(['action' => ['MessagesController@destroy', $message->id], 'method' => 'DELETE', 'onsubmit' => 'return confirm("Sigur stergeti?")'])!!}
                {{Form::bsSubmit('Sterge Mesaj', ['class'=> 'btn btn-danger btn-xs pull-right'])}}
            {!! Form::close() !!}
        </li>       

      </ul>
    @endforeach
  @endif
</div>
<div class="text-center">{{$messages->links()}}</div>

@endsection
