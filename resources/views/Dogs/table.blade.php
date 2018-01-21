@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
           {{--  <h4>Total caini: {{$dogs->total()}} </h4>   --}}
            <div class="panel panel-default">
                @if(Auth::check())<div class="panel-heading">Caini:<a href="/dogs/create" class="pull-right btn btn-success btn-xs">Adauga caine</a></div>@endif
                    <table class="table text-center">
                        <tr>
                            @if (Auth::check())<td style="font-weight:bold">ID Caine</td>@endif
                            <td style="font-weight:bold">Nume Caine</td>
                            <td style="font-weight:bold">Rasa</td>
                            <td style="font-weight:bold">Culoare</td>
                            <td style="font-weight:bold">Sex</td>
                            @if (Auth::check())<td style="font-weight:bold">Serie Microcip</td>@endif
                            <td style="font-weight:bold">Data nastere</td>
                            <td style="font-weight:bold">Description</td>
                            <td style="font-weight:bold">Notes</td>
                            <td style="font-weight:bold">Prima zi in adapost</td>
                            <td style="font-weight:bold">Adoptat</td>
                        </tr>


@foreach($dogs as $dog)
    <tr>
        @if (Auth::check())<td style="font-weight:bold">{{$dog->id}}</td>@endif
        <td><a href='/albums/{{$dog->id}}'>{{$dog->name }}</a></td>
        <td>{{$dog->breed}}</td>
        <td>{{$dog->color}}</td>
        <td>{{$dog->sex}}</td>
        @if (Auth::check())<td>{{$dog->microchip}}</td>@endif
        <td>{{ \Carbon\Carbon::parse($dog->birthdate)->format('d.m.Y')}}</td>
        <td>{{\Illuminate\Support\Str::limit($dog->description, 10)}}</td>
        <td>{{$dog->notes}}</td>
        {{--  {{ $background = $dog->background->sortByDesc('join_shelter_date') }}  --}}
        <td>{{\Carbon\Carbon::parse($dog->background[0]->join_shelter_date)->format('d.m.Y')}}</td>
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