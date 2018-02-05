@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
                <h4>Total inregistrari: {{$medicalrecords->total()}} </h4> 
            <div class="panel panel-default">
                <div class="panel-heading">Istoric Medical<a href="/medicalrecords/create" class="pull-right btn btn-success btn-xs">Adauga inregistrare</a></div>
                    <table class="table text-center">
                        <tr>
                            <td style="font-weight:bold">Nume Caine</td>
                            <td style="font-weight:bold">ID Caine</td>
                            <td style="font-weight:bold">Data ultimului vaccin de rabie</td>
                            <td style="font-weight:bold">Urmatoarea data vaccinului de rabie</td>
                            <td style="font-weight:bold">Data ultimei deparazitari interne</td>
                            <td style="font-weight:bold">Data urmatoarei deparazitari interne</td>
                            <td style="font-weight:bold">Sterilizat</td>
                        </tr>


@foreach($medicalrecords as $key => $medicalrecord)
    <tr>
        <td><a href='/albums/{{$medicalrecord->dog->id}}'>{{$medicalrecord->dog->name }}</a></td>
        <td>{{$medicalrecord->dog->id}}</td>
        <td>{{ \Carbon\Carbon::parse($medicalrecord->rabies_vaccine_date)->format('d.m.Y')}}</td>
        <td>{{\Carbon\Carbon::parse($medicalrecord->next_rabies_vaccine_date)->format('d.m.Y')}}</td>
        <td>{{\Carbon\Carbon::parse($medicalrecord->deworming_date)->format('d.m.Y')}}</td>
        <td>{{\Carbon\Carbon::parse($medicalrecord->next_deworming_date)->format('d.m.Y')}}</td>
        <td>{{$medicalrecord->sterilized ===0? 'Nu' :'Da'}}</td>

        <td><a class="pull-right btn btn-info" href="medicalrecords/{{$medicalrecord->id}}/show">SHOW</a></td>
        <td><a class="pull-right btn btn-warning" href="medicalrecords/{{$medicalrecord->id}}/edit">EDIT</a></td>
        <td>

        {{ Form::open(['method' => 'DELETE', 'route' => ['medicalrecords.destroy', $medicalrecord->id]]) }}
        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
    {{ Form::close() }}    

        </td>
    </tr>
@endforeach
<div class="text-center">{{$medicalrecords->links()}} </div>







            </div>
        </div>
    </div>
</div>


@endsection