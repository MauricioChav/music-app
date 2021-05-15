@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="px-4 mb-5 text-center front-banner">
      <h1 class="display-4 fw-bold">¿Qué hay de nuevo {{ Auth::user()->name }} ?</h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Te encuentras en el panel principal de Thunder Player. Accede al menú de canciones o álbums para comenzar.</p>

        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
          <a href="{{ route('songs.index') }}" class="btn btn-primary btn-lg px-4 me-sm-3">Canciones</a>
          <a href="{{ route('albums.index') }}" class="btn btn-primary btn-lg px-4 me-sm-3">Álbums</a>
          
        </div>
      </div>
      <div class="overflow-hidden" style="max-height: 30vh;">
        <div class="container px-5">
          
        </div>
      </div>
    </div>
</div>
@endsection
