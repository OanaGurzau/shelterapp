@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-center">
      <h1>Albume caini</h1>
      <h3>Total albume: {{$albums->total()}}</h3>
      <br>
      <a href="/albums/create" class="btn btn-primary btn-xs pull-right">Creaza album</a>
<br>      
<hr>
    <a href="{{ url()->current() }}/?adoptat=adoptat" class="btn btn-success btn-md">Adoptati</a>
    <a href="{{ url()->current() }}/?adoptat=neadoptat" class="btn btn-warning btn-md">Neadoptati</a>
    <a href="{{ url()->current() }}/" class="btn btn-info btn-md">Resetare</a>
    
<hr>
  </div>
    
</div>
<br><br>
  @if(count($albums) > 0)
    <?php
      $colcount = count($albums);
  	  $i = 1;
    ?>
        <div class="container">
      <div class="row text-center">
        @foreach($albums as $album)
          @if($i == $colcount)
             <div class='col-md-4' style="align-items: end">
               <a href="/albums/{{$album->id}}">
                @if($album->cover_image!=null)
                <img class="img-thumbnail" src="/storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}">
                @else 
                <img class='img-thumbnail' src="/storage/inc/default.jpg" alt="$album->name}}">
                @endif
                </a>
               <h4>{{$album->dog->name}}</h4>
               <br>
          @else
            <div class='col-md-4'>
              <a href="/albums/{{$album->id}}">
                @if($album->cover_image!=null)
                <img class="img-thumbnail" src="/storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}">
                @else 
                <img class='img-thumbnail' src="/storage/inc/default.jpg" alt="$album->name}}">
                @endif
              </a>
              <h4>{{$album->dog->name}}</h4>
              <br>
          @endif
        	@if($i % 3 == 0)
          </div></div><div class="row text-center">
        	@else
            </div>
          @endif
        	<?php $i++; ?>
        @endforeach
        
      </div>
    </div>
    
  @else
    <div class="container">
      <p>No Albums To Display</p>
    </div>
  @endif
  <div class="text-center">
    {{$albums->links()}}
  </div>
@endsection
