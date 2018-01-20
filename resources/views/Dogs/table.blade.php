@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <h4>Total caini: {{$dogs->total()}} </h4> 
            <div class="panel panel-default">
                @if(Auth::check())<div class="panel-heading">Caini:<a href="/dogs/create" class="pull-right btn btn-success btn-xs">Adauga caine</a></div>@endif
                    <table class="table text-center">
                        <tr>
                            @if (Auth::check())<td>ID Caine</td>@endif
                            <td>Nume Caine</td>
                            <td>Rasa</td>
                            <td>Culoare</td>
                            <td>Sex</td>
                            @if (Auth::check())<td>Serie Microcip</td>@endif
                            <td>Data nastere</td>
                            <td>Description</td>
                            <td>Notes</td>
                            <td>Prima zi in adapost</td>
                            <td>Adoptat</td>
                        </tr>


@foreach($dogs as $dog)
    <tr>
        @if (Auth::check())<td>{{$dog->id}}</td>@endif
        <td>{{$dog->name }}</a></td>
        <td>{{$dog->breed}}</td>
        <td>{{$dog->color}}</td>
        <td>{{$dog->sex}}</td>
        @if (Auth::check())<td>{{$dog->microchip}}</td>@endif
        <td>{{ \Carbon\Carbon::parse($dog->birthdate)->format('d.m.Y')}}</td>
        <td>{{\Illuminate\Support\Str::limit($dog->description, 10)}}</td>
        <td>{{$dog->notes}}</td>
        <td>{{\Carbon\Carbon::parse($dog->join_shelter_date)->format('d.m.Y')}}</td>
        <td>{{$dog->adopted ===0? 'Nu' :'Da'}}</td>

       
        <td><a class="pull-right btn btn-info" href="dogs/{{$dog->id}}/show">SHOW</a></td>
        @if (Auth::check())
        <td><a class="pull-right btn btn-warning" href="dogs/{{$dog->id}}/edit">EDIT</a></td>
        
        <td>
        {{--  {!!Form::open(['action' => ['DogsController@destroy', $dog->id], 'method' => 'POST', 'onsubmit' => 'return confirm("Stergi inregistrarea?")'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::bsSubmit('Delete', ['class'=> 'btn btn-danger'])}}
        {!! Form::close() !!}  --}}

        {{ Form::open(['method' => 'DELETE', 'route' => ['dogs.destroy', $dog->id]]) }}
        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
    {{ Form::close() }}    
        </td>
        @endif
    </tr>
@endforeach

  <div class="text-center">{{$dogs->links()}} </div>

            </div>
        </div>
    </div>
</div>


@endsection