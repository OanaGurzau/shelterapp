@extends('layouts.app')
@section('content')

<div class="container">
<h1 class="text-center">Adoptatori</h1><a href="/adopter" class="pull-right btn btn-primary btn-xs">Inapoi la adoptatori</a>
<br>

<dl class="dl-horizontal" style="font-size:20px">
        
        <dt>Id</dt>
        <dd>{{$adopter->id}}</dd>

        <dt>Nume complet</dt>
        <dd>{{$adopter->name}}</dd>

        <dt>Adresa</dt>
        <dd>{{$adopter->address}}</dd>
        
        <dt>Judet</dt>
        <dd>{{$adopter->county}}</dd>
        
        <dt>Oras</dt></dt>
        <dd>{{$adopter->city}}</dd>
        
        <dt>Nr Tel</dt>
        <dd>{{$adopter->phone_number}}</dd>
        
        <dt>Email</dt>
        <dd>{{$adopter->email}}</dd>
        
        <dt>Ultima vizita</dt>
        <dd>{{$adopter->last_home_visit}}</dd>
        
        <dt>Extra</dt>
        <dd>{{$adopter->nfod}}</dd>
        
    </dl>

   
    
</div>






@endsection