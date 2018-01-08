@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <h4>Total inregistrari: {{$medicalrecords->total()}} </h4> 
            <div class="panel panel-default">
                <div class="panel-heading">Istoric Medical<a href="/medicalrecord/create" class="pull-right btn btn-success btn-xs">Adauga inregistrare</a></div>
                    <table class="table text-center">
                        <tr>
                            <td>Nume Caine</td>
                            <td>ID Caine</td>
                            <td>Data ultimului vaccin de rabie</td>
                            <td>Urmatoarea data vaccinului de rabie</td>
                            <td>Data ultimei deparazitari interne</td>
                            <td>Data urmatoarei deparazitari interne</td>
                            <td>Sterilizat</td>
                            <td></td>
                        </tr>


@foreach($medicalrecords as $key => $medicalrecord)
    <tr>
        <td><a href='/albums/{{$medicalrecord->id}}'>{{$medicalrecord->name }}</a></td>
        <td>{{$medicalrecord->id}}</td>
        <td>{{ \Carbon\Carbon::parse($medicalrecord->rabies_vaccine_date)->format('d.m.Y')}}</td>
        <td>{{\Carbon\Carbon::parse($medicalrecord->next_rabies_vaccine_date)->format('d.m.Y')}}</td>
        <td>{{\Carbon\Carbon::parse($medicalrecord->deworming_date)->format('d.m.Y')}}</td>
        <td>{{\Carbon\Carbon::parse($medicalrecord->next_deworming_date)->format('d.m.Y')}}</td>
        <td>{{$medicalrecord->sterilized ===0? 'Nu' :'Da'}}</td>

        <td><a class="pull-right btn btn-info" href="medicalrecord/{{$medicalrecord->id}}/show">SHOW</a></td>
        <td><a class="pull-right btn btn-warning" href="medicalrecord/{{$medicalrecord->id}}/edit">EDIT</a></td>
        <td>
        {!!Form::open(['action' => ['MedicalRecordsController@destroy', $medicalrecord->id], 'method' => 'POST', 'onsubmit' => 'return confirm("Stergi inregistrarea?")'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::bsSubmit('Delete', ['class'=> 'btn btn-danger'])}}
        {!! Form::close() !!}
        </td>
    </tr>
@endforeach
<div class="text-center">{{$medicalrecords->links()}} </div>







            </div>
        </div>
    </div>
</div>


@endsection