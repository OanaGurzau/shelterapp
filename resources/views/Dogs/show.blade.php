@extends('layouts.app')

@section('content')

<div class="container">
        <div class="row">
        <h1 class="text-center">Caine</h1><a href="/dogs" class="pull-right btn btn-primary btn-xs">Inapoi la lista cainilor</a>
                
@if(Auth::check())<div class="form-group">
        <strong>ID caine: </strong> {{$background->dog->id}}
</div>@endif
<div class="form-group">
        <strong>Nume caine: </strong> {{$background->dog->name}}
</div>
<div class="form-group">
        <strong>Rasa: </strong> {{$background->dog->breed}}
</div>
<div class="form-group">
        <strong>Culoare: </strong> {{$background->dog->color}}
</div>
<div class="form-group">
        <strong>Sex: </strong> {{$background->dog->sex}}
</div>
@if(Auth::check())<div class="form-group">
        <strong>Serie Microcip: </strong> {{$background->dog->microchip}}
</div>@endif
<div class="form-group">
        <strong>Data Nastere: </strong> {{\Carbon\Carbon::parse($background->dog->birthdate)->format('d.m.Y')}}
</div>
<div class="form-group">
        <strong>Descriere: </strong> {{$background->dog->description}}
</div>
<div class="form-group">
        <strong>Informatii extra: </strong> {{$background->dog->notes}}
</div>
<div class="form-group">
        <strong>Prima zi a cainelui in adapost: </strong> {{$background->join_shelter_date->format('d.m.Y')}}
</div>



</div>
</div>

@endsection