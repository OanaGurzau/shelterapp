@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12  col-md-offset-0">
                <h4>Total adoptatori: {{$adopters->total()}} </h4> 
            <div class="panel panel-default">
                <div class="panel-heading">Adoptatori<a href="/adopter/create" class="pull-right btn btn-success btn-xs">Adauga adoptator</a></div>
                    <table class="table text-center">
                        <tr>
                            <td style="font-weight:bold">ID</td>
                            <td style="font-weight:bold">Nume complet</td>
                            <td style="font-weight:bold">Adresa</td>
                            <td style="font-weight:bold">Judet</td>
                            <td style="font-weight:bold">Oras</td></td>
                            <td style="font-weight:bold">Nr Tel</td>
                            <td style="font-weight:bold">Email</td>
                            <td style="font-weight:bold">Ultima vizita la domiciliu</td>
                            <td style="font-weight:bold">Informatii</td>
                            <td></td>
                            <td></td>
                        </tr>


@foreach($adopters as $adopter)
    <tr>
        <td>{{$adopter->id}}</td>
        <td>{{$adopter->name}}</td>
        <td>{{$adopter->address}}</td>
        <td>{{$adopter->county}}</td>
        <td>{{$adopter->city}}</td>
        <td>{{$adopter->phone_number}}</td>
        <td>{{$adopter->email}}</td>
        <td>{{$adopter->last_home_visit->format('d.m.Y')}}</td>
        <td>{{$adopter->info}}</td>

        <td><a class="pull-right btn btn-info" href="adopter/{{$adopter->id}}/show">SHOW</a></td>
        <td><a class="pull-right btn btn-warning" href="adopter/{{$adopter->id}}/edit">EDIT</a></td>
        <td>
        {!!Form::open(['action' => ['AdoptersController@destroy', $adopter->id], 'method' => 'POST', 'onsubmit' => 'return confirm("Stergi inregistrarea?")'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::bsSubmit('Delete', ['class'=> 'btn btn-danger'])}}
        {!! Form::close() !!}
        </td>
    </tr>

@endforeach
<div class="text-center">{{$adopters->links()}} </div>







            </div>
        </div>
    </div>
</div>

@endsection