@extends('layouts.master')

@section('content')	
<div class="container-fluid cover-img">
    <div class="px-4 mb-5 text-center front-banner">
      <h1 class="display-4 fw-bold">Thunder Player: La app de música diseñada para ti </h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">ThunderPlayer te permite crear tu propia biblioteca musical de manera cómoda y sencilla</p>

        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
          <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4 me-sm-3">Registrate Ahora</a>
        </div>
      </div>
      <div class="overflow-hidden" style="max-height: 30vh;">
        <div class="container px-5">
          
        </div>
      </div>
    </div>
</div>

<div class="container">
  <div class="row">
        <div class="col-4 text-center">
          <img class="home-icon" src="{{ asset('css/img/Icon_Album.png') }}">
          <h2>Crea Álbums para contener tus canciones</h2>
        </div>

        <div class="col-4 text-center">
          <img class="home-icon" src="{{ asset('css/img/Icon_File.png') }}">
          <h2>Sube tus canciones</h2>
        </div>

        <div class="col-4 text-center">
          <img class="home-icon" src="{{ asset('css/img/Icon_Headphones.png') }}">
          <h2>Disfruta de tu biblioteca personal</h2>
        </div>

</div>
  
</div>

@endsection