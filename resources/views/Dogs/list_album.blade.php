@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row">
    <h2>Albume caini</h2>
    <br>
    </div>
    </div>
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
                  <img class="img-thumbnail" src="storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}">
                </a>
               <br>
               <h4>{{$album->name}}</h4>
          @else
            <div class='col-md-4 columns'>
              <a href="/albums/{{$album->id}}">
                <img class="img-thumbnail" src="storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}">
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
    <p>No Albums To Display</p>
  @endif

@endsection









    {{--  @if(count($albums))
     <div id="albums">
     <div class="container">
      <div class="row text-center">
      @foreach($albums as $album)
         <h4>{{$album->name}}</h4>
            
               <a href="dogs/albums/{{$album->id}}">
                  <img class="thumbnail" src="storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}">
                </a>
            </div>
        @endforeach
    </div>
    </div>
    @endif
    </div>  --}}






  








{{--  <div class="container">
    <div class="row">
        <h3>Albume</h3>
        @foreach($albums as $album)
        {{$album->name}}
        @endforeach
    </div>

</div>

@endsection

<div class="row">
    <div class=""
</div>  --}}