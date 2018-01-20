@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row">
        <h1 class="text-center">Caine</h1><a href="/dogs" class="pull-right btn btn-primary btn-xs">Inapoi la lista cainilor</a>
                
@if(Auth::check())<div class="form-group">
        <strong>ID caine: </strong> {{$dog->id}}
</div>@endif
<div class="form-group">
        <strong>Nume caine: </strong> {{$dog->name}}
</div>
<div class="form-group">
        <strong>Rasa: </strong> {{$dog->breed}}
</div>
<div class="form-group">
        <strong>Culoare: </strong> {{$dog->color}}
</div>
<div class="form-group">
        <strong>Sex: </strong> {{$dog->sex}}
</div>
@if(Auth::check())<div class="form-group">
        <strong>Serie Microcip: </strong> {{$dog->microchip}}
</div>@endif
<div class="form-group">
        <strong>Data Nastere: </strong> {{\Carbon\Carbon::parse($dog->birthdate)->format('d.m.Y')}}
</div>
<div class="form-group">
        <strong>Descriere: </strong> {{$dog->description}}
</div>
<div class="form-group">
        <strong>Informatii extra: </strong> {{$dog->notes}}
</div>
<div class="form-group">
        <strong>Prima zi a cainelui in adapost: </strong> {{$background->join_shelter_date->format('d.m.Y')}}
</div>



</div>
</div>

@endsection