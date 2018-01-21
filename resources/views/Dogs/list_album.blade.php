@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row text-center">
      <h1>Albume caini</h1>
      <h3>Total albume: {{$albums->total()}}</h3>
      <br>
    </div>

    
</div>
<br><br>
  @if(count($albums) > 0)
    <?php
      $colcount = count($albums);
  	  $i = 1;
    ?>
     {{--  <div class="album text-muted">  --}}
        <div class="container">
      <div class="row text-center">
        @foreach($albums as $album)
          @if($i == $colcount)
             <div class='col-md-4' style="align-items: end">
               <a href="/albums/{{$album->id}}">
                  <img class="img-thumbnail" src="/storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}">
                </a>
               <h4>{{$album->dog->name}}</h4>
               <br>
          @else
            <div class='col-md-4'>
              <a href="/albums/{{$album->id}}">
                <img class="img-thumbnail" src="/storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}">
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
    {{--  </div>  --}}
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
