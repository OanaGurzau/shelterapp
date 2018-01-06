@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-center">
      <h1>Albume caini</h1>
      <h3>Total albume: {{$albums->total()}}</h3>
      <br>
    </div>
    <a class="btn btn-info btn-lg pull-right" href="/albums/create/">Creaza un album</a>

    
</div>
<br><br>
  @if(count($albums) > 0)
    <?php
      $colcount = count($albums);
  	  $i = 1;
    ?>
     <div class="album text-muted">
        <div class="container">
      <div class="row text-center">
       <div class="card">
        @foreach($albums as $album)
          @if($i == $colcount)
             <div class='col-md-4 end'>
               <a href="/albums/{{$album->id}}">
                  <img class="img-thumbnail" src="/storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}">
                </a>
               <br>
               <h4>{{$album->name}}</h4>
          @else
            <div class='col-md-4 columns'>
              <a href="/albums/{{$album->id}}">
                <img class="img-thumbnail" src="/storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}">
              </a>
              <br>
              <h4>{{$album->name}}</h4>
          @endif
        	@if($i % 3 == 0)
          </div></div></div><div class="row text-center">
        	@else
            </div>
          @endif
        	<?php $i++; ?>
        @endforeach
        
      </div>
    </div>
    </div>
  @else
    <div class="container">
      <p>No Albums To Display</p>
    </div>
  @endif
  <div class="row text-center">
    {{$albums->links()}}
  </div>
@endsection
