@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="px-4 mb-5 text-center front-banner">
      <h1 class="display-4 fw-bold"> Crear Canción </h1>
      <div class="col-lg-6 mx-auto">

        @if(count( $albums ) == 0)

        <p class="lead mb-4">Para añadir una canción, debes crear un nuevo álbum</p>

        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
          <a href="{{ route('albums.create') }}" class="btn btn-primary btn-lg px-4 me-sm-3">Crear Nuevo Álbum</a>
        </div>

        @else

        <p class="lead mb-4">Para añadir una canción, debes crear un nuevo álbum o seleccionar un álbum preexistente</p>

        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
          <a href="{{ route('albums.create') }}" class="btn btn-primary btn-lg px-4 me-sm-3">Crear Nuevo Álbum</a>
          <a href="{{ route('albums.index') }}" class="btn btn-primary btn-lg px-4 me-sm-3">Seleccionar Álbum Preexistente</a>
        </div>

        @endif


        
      </div>
      <div class="overflow-hidden" style="max-height: 30vh;">
        <div class="container px-5">
          
        </div>
      </div>
    </div>
</div>
@endsection
