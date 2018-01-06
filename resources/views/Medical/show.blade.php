@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Istoric Medical</div>
                    <table class="table">
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


    {{--  @if(count($dogs) > 0)
        @foreach($dogs as $dog)
        
             {{--  <td><a href='/albums/{{$dog->id}}'>{{$dog->name}}</a></td>  --}}
{{--               
            
        @endforeach
@endif  --}}  



@foreach($medicalrecords as $key => $medicalrecord)
    <tr>
        <td><a href='/albums/{{$medicalrecord->id}}'>{{$medicalrecord->name }}</a></td>
        <td>{{$medicalrecord->id}}</td>
        <td>{{$medicalrecord->rabies_vaccine_date}}</td>
        <td>{{$medicalrecord->next_rabies_vaccine_date}}</td>
        <td>{{$medicalrecord->deworming_date}}</td>
        <td>{{$medicalrecord->next_deworming_date}}</td>
        <td>{{$medicalrecord->sterilized}}</td>
        <td><a class="pull-right btn btn-default" href="medicalrecord/{{$medicalrecord->id}}/edit">EDIT</a></td>
        <td>
        {!!Form::open(['action' => ['MedicalRecordsController@destroy', $medicalrecord->id], 'method' => 'POST', 'onsubmit' => 'return confirm("Stergi inregistrarea?")'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::bsSubmit('Delete', ['class'=> 'btn btn-danger'])}}
        {!! Form::close() !!}
        </td>
    </tr>








@endforeach






            </div>
        </div>
    </div>
</div>


@endsection