@extends('layouts.app')
@section('content')

<div class="container">
<h1 class="text-center">Istoric Medical</h1><a href="/medicalrecords" class="pull-right btn btn-primary btn-xs">Inapoi la istoric medical</a>
<br>

<ul class="list-inline" style="font-size:20px">
        
        <li><strong>Id</strong></li>
        <li>{{$medicalrecords->id}}</li>
</ul>

<hr>

<ul class="list-inline" style="font-size:20px">
        <li><strong>Ultimul vaccin</strong></li>
        <li>{{$medicalrecords->rabies_vaccine_date->format('d.m.Y')}}</li>
        <div class="pull-right">
            <li><strong>Urmatorul vaccin</strong></li>
            <li>{{$medicalrecords->next_rabies_vaccine_date->format('d.m.Y')}}</li>
        </div>
       
</ul>   
<br> <hr> 

<ul class="list-inline" style="font-size:20px">
        <li><strong>Ultima deparazitare</strong></li>
        <li>{{$medicalrecords->deworming_date->format('d.m.Y')}}</li>
        <div class="pull-right">
            <li><strong>Urmatoarea deparazitare</strong></li>
            <li>{{$medicalrecords->next_deworming_date->format('d.m.Y')}}</li>
        </div>
</ul>

<br><hr>

<ul class="list-inline" style="font-size:20px">
        <dt>Sterilizat/Castrat</dt>
        <dd>{{$medicalrecords->sterilized ===0? 'Nu' :'Da'}}</dd>
                
</ul>

   
    
</div>






@endsection