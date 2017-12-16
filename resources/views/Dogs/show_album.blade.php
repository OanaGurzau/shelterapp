@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row text-center">
    <h1>{{$album->name}}</h1>
    </div>
        <a class="btn btn-primary btn-lg" href="/albums">Inapoi la Albume</a>
        <a class="btn btn-info btn-lg pull-right" href="/photos/create/{{$album->id}}">Incarca poze in album</a>

    </div>


  @if(count($album->photos) > 0)   
    <?php
      $colcount = count($album->photos);
  	  $i = 1;
    ?>
     <div id="photos">
        <div class="container">
      <div class="row text-center">
       <div class="card">
        @foreach($album->photos as $photo)
          @if($i == $colcount)
             <div class='col-md-4 end'>
                  <img class="img-thumbnail" src="/storage/photos/{{$photo->dog_album_id}}/{{$photo->photo}}" alt="{{$photo->title}}">
                </a>
               <br>
               <h4>{{$photo->title}}</h4>
          @else
            <div class='col-md-4 columns'>
                  <img class="img-thumbnail" src="/storage/photos/{{$photo->dog_album_id}}/{{$photo->photo}}" alt="{{$photo->title}}">
                </a>
               <br>
               <h4>{{$photo->title}}</h4>
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
    <p>Nicio poza in album</p>
  @endif




<div class="container">
<p>{{$dogs->name}}</p>
</div>



@endsection