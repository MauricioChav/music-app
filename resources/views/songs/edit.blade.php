@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
             <div class="card mt-5">
                <div class="card-header green-title"><h1 class="green-title">Editar {{ $song->name }} </h1></div>
                <div class="card-body">
	
				<form method="POST" action="{{ route('songs.update', $song->id) }}" enctype="multipart/form-data">
					<!--Campo de protección de Formulario-->
					{{ csrf_field() }}
					<!-- Se sobrescribe metodo, pues siempre se necesita de enviar la info como POST-->
					{{ method_field('PUT') }}
					
					<!--<input type="hidden" name="origin" value=1>-->

					<div class="form-group row">
							<div class="col-9" style="margin: auto;">
	                            
								<label class="mt-3">Nombre de la canción</label>

								<input required maxlength="35" class="form-control" type="text" name="name" placeholder="Nombre de la canción" value="{{ $song->name }}">
								
						</div>
					</div>
									
					<div class="form-group row">
							<div class="col-9" style="margin: auto;">
	                            
								<label class="mt-3">Track</label>

								<input maxlength="3" class="form-control" type="number" name="track" placeholder="No." value="{{ $song->track }}">
								
						</div>
					</div>

					<div class="form-group row">
							<div class="col-9" style="margin: auto;">
	                            
								<label class="mt-3">Sustituir Archivo (El archivo actual es {{ $song->music_file }} )</label>

								<input class="form-control" type="file" name="music_file" accept="audio/*">
								
						</div>
					</div>
					
					
					<div class="form-group row mb-0">
                            <div class="col-9" style="margin: auto;">
					<button class="btn btn-primary mt-3" type="submit">Actualizar canción</button>
					<a class="btn btn-secondary mt-3" href="{{ route('albums.show', $song->album_id) }}">Ir al Álbum</a>
					<a class="btn btn-secondary mt-3" href="{{ route('songs.index') }}">Regresar a canciones</a>
					
				</div>
			</div>

				</form>
			</div>
		</div>
        </div>
    </div>
</div>
	
@endsection