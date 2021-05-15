@extends('layouts.master')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
             <div class="card mt-5">
                <div class="card-header green-title"><h1 class="green-title">Editar {{ $album->name }}</h1></div>
                <div class="card-body">
	
				<form method="POST" action="{{ route('albums.update', $album->id) }}" enctype="multipart/form-data">
					<!--Campo de protección de Formulario-->
					{{ csrf_field() }}
					<!-- Se sobrescribe metodo, pues siempre se necesita de enviar la info como POST-->
					{{ method_field('PUT') }}
					
					<!--<input type="hidden" name="origin" value=1>-->

					<div class="form-group row">

						<div class="col-4" style="margin: auto;">
	                     
	                     	<img alt="{{ $album->name }}_cover" src="{{ asset('storage/album_covers/') }}/{{$album->cover}}" width="100%">
								
								
						</div>

							<div class="col-5" style="margin: 0 auto;">
	                            
								<label class="mt-3">Nombre del álbum</label>

								<input required maxlength="35" class="form-control" type="text" name="name" placeholder="Nombre del álbum" value="{{ $album->name }}">

								<label class="mt-3">Artista</label>

								<input required maxlength="35" class="form-control" type="text" name="artist" placeholder="Artista" value="{{ $album->artist }}">

								<label class="mt-3">Año</label>

								<input maxlength="4" class="form-control" type="number" name="year" placeholder="Año" value="{{ $album->year }}">
								
						</div>
					</div>

					<div class="form-group row">
							<div class="col-9" style="margin: auto;">
	                            
								<label class="mt-3">Cambiar portada</label>

								<input class="form-control" type="file" name="cover" accept="image/*">
								
						</div>
					</div>
					
					
					<div class="form-group row mb-0 pt-3 pb-2">
                            <div class="col-9" style="margin: auto;">
					<button class="btn btn-primary mt-3" type="submit">Actualizar Álbum</button>
					<a class="btn btn-secondary mt-3" href="{{ route('albums.show' , $album->id) }}">Regresar</a>
				</div>
			</div>

				</form>
			</div>
		</div>
        </div>
    </div>
</div>
@endsection