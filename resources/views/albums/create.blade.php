@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
             <div class="card mt-5">
                <div class="card-header green-title"><h1 class="green-title">Nuevo Álbum</h1></div>
                <div class="card-body">
	
				<form method="POST" action="{{ route('albums.store') }}" enctype="multipart/form-data">
					<!--Campo de protección de Formulario-->
					{{ csrf_field() }}
					
					<input class="form-control" type="hidden" name="origin" value="{{ Auth::user()->id }}">


					<div class="form-group row">
							<div class="col-9" style="margin: auto;">
	                            
								<label class="mt-3">Nombre del álbum</label>

								<input required maxlength="35" class="form-control" type="text" name="name" placeholder="Nombre del álbum">
								
						</div>
					</div>
									
					<div class="form-group row">
							<div class="col-9" style="margin: auto;">
	                            
								<label class="mt-3">Artista</label>

								<input required maxlength="35" class="form-control" type="text" name="artist" placeholder="Artista">
								
						</div>
					</div>

					<div class="form-group row">
							<div class="col-9" style="margin: auto;">
	                            
								<label class="mt-3">Año</label>

								<input maxlength="4" class="form-control" type="number" name="year" placeholder="Año">
								
						</div>
					</div>

					<div class="form-group row">
							<div class="col-9" style="margin: auto;">
	                            
								<label class="mt-3">Portada del álbum</label>

								<input class="form-control" type="file" name="cover" accept="image/*">
								
						</div>
					</div>
					
					
					<div class="form-group row mb-0">
                            <div class="col-9" style="margin: auto;">
					<button class="btn btn-primary mt-3" type="submit">Crear Álbum</button>
					<a class="btn btn-secondary mt-3" href="{{ route('albums.index') }}">Regresar</a>
				</div>
			</div>

				</form>
			</div>
		</div>
        </div>
    </div>
</div>
	
@endsection