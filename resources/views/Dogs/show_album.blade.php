@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row text-center">
    <h1>{{$album->name}}</h1>
    </div>
        <a class="btn btn-primary btn-lg" href="/albums">Inapoi la Albume</a>
        <a class="btn btn-info btn-lg pull-right" href="/photos/create/{{$album->id}}">Incarca poze in album</a>
        <a class="btn btn-info btn-lg pull-right" href="/albums/{{$album->id}}/edit">Editeaza album</a><br><br>
        {!!Form::open(['action' => ['DogsAlbumsController@destroy', $dogs->id], 'method' => 'DELETE', 'onsubmit' => 'return confirm("Sigur stergeti?")' ,'enctype' => 'multipart/form-data'])!!}
            {{Form::bsSubmit('Delete', ['class'=> 'btn btn-dannger'])}}
        {!! Form::close() !!}
</div>
<br><br>

{{--  Animal details START  --}}

<div class="container">
  <div class="left">
  <img src="/storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}">
  </div>
  <div class="right">
    <dl class="row">
      <dt class="col-sm-5 text-primary">Nume:</dt>
        <dd class="col-sm-7">
            @if($dogs!==null)
              {{$dogs->name}}
            @endif
        </dd>
      <dt class="col-sm-5 text-primary">Rasa:</dt>
        <dd class="col-sm-7">
            @if($dogs!==null)
              {{$dogs->breed}}
            @endif
        </dd>
      <dt class="col-sm-5 text-primary">Culoare:</dt>
        <dd class="col-sm-7">
            @if($dogs!==null)
              {{$dogs->color}}
            @endif
        </dd>
      <dt class="col-sm-5 text-primary">Sex:</dt>
        <dd class="col-sm-7">
            @if($dogs!==null)
              {{$dogs->sex}}
            @endif
        </dd>

      <dt class="col-sm-5 text-primary">Zi de nastere:</dt>
        <dd class="col-sm-7">
            @if($dogs!==null)
              {{$dogs->birthdate->format('d.m.Y')}}
            @endif
        </dd>

      <dt class="col-sm-5 text-primary">In adapost:</dt>
        <dd class="col-sm-7">
            @if($background!==null)
              {{$background->join_shelter_date->format('d.m.Y')}}
            @endif
        </dd>

      <dt class="col-sm-5 text-primary">Sterilizat:</dt>
        <dd class="col-sm-7">
            @if($medicalrecord!==null)
              {{$medicalrecord->sterilized===0? 'Nu' :'Da'}}
            @endif
        </dd>


      <dt class="col-sm-5 text-primary">Nota:</dt>
        <dd class="col-sm-7">
            @if($dogs!==null)
              {{$dogs->notes}}
            @endif
        </dd>

    </dl>
  </div>

<br style="clear:both" /><br>



<hr>

  <div class="descriptionbg">
  <dt class="col-sm-2 text-primary">Descriere:</dt>
    <dd class="col-sm-10 " style="border-radius: 15px 50px; border-style: 5px solid black;">
      
        @if($dogs->description!==null)
          {{$dogs->description}}
        @endif
  </div>
    </dd>




<hr>



<h2 class="text-primary"><b>Mai multe poze:</b></h2>
</div>
<br><br>


  @if(count($album->photos) > 0)   
    <?php
      $colcount = count($album->photos);
  	  $i = 1;
    ?>
     <div id="photos">
        <div class="container">
      <div class="row text-center">
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
          </div></div><div class="row text-center">
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
      <p>Fara alte poze</p>
    </div>
  @endif


  {{--  Animal detail ends  --}}




@endsection