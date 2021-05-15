@extends('layouts.master')

@section('content')	

<div class="container my-4">

	<div class="row align-items-center">
		<div class="col-md-4">
		@if(count( $albums ) == 0)
		<a href="{{ route('albums.index') }}" class="btn btn-primary btn-lg px-4 me-sm-3">Ir a Álbums</a>
		@else
			<!--
			<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#songModal">
				Crear Nueva Canción
			</button>
		-->

		@endif


		
		</div>

	
	</div>
</div>
    


<div class="container">
<div class="container-fluid">
    <div class="px-4 mb-5 text-center">
      <h1 class="display-4 fw-bold green-title">Listado de canciones</h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Aqui podrás encontrar todas las canciones de la app</p>
        
        @if(count( $songs ) == 0)
         <p class="lead mb-4" style="font-weight: bold;
">Áun no existen canciones registradas. Para comenzar añade tu primer canción:</p>
		<a href="{{ route('albums.chooseCreate') }}" class="btn btn-primary btn-lg px-4 me-sm-3">Crear Canción</a>

        @endif

        

      </div>
      <div class="overflow-hidden" style="max-height: 30vh;">
        <div class="container px-5">
          
        </div>
      </div>
    </div>
</div>
</div>



<div class="modal fade" id="songModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title green-title-sm" id="exampleModalLabel">Crear Nueva Canción</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
	  
	  <form method="POST" action="{{ route('songs.store') }}">
      <div class="row">
      	<div class="modal-r-body col-8" style="margin: auto;">
        <!--Campo de protección de Formulario-->
			{{ csrf_field() }}
			
			<div class="form-group mb-3">
				<label>Nombre de Canción</label>
				<input maxlength="35" required class="form-control" type="text" name="name" placeholder="Nombre de Canción">
			</div>
			
			<div class="form-group mb-3">
				<label>Descripción</label>
				<texCanción required class="form-control" name="description"></texCanción>
			</div>

			<div class="form-group mb-3">
				<label>Proyectos</label>
				<select class="form-control" name="project_id">
					@foreach($albums as $project)
					<option value="{{ $project->id }}">{{ $project->name }}</option>
					@endforeach
				</select>
			</div>
			
			<div class="form-group mb-3">
				<label>Fecha de entrega</label>
				<input required class="form-control" type="date" name="due_date">
			</div>
      		</div>
      </div>
      <div class="modal-footer col-8" style="margin: auto;">
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
	  </form>
	  
    </div>
  </div>
</div>

<div class="container">
	<div class="row">
		
		<div class="col-md-12">
			
			<div class="card">
				
				<div class="card-body">
				
				<table class="table">
				<thead>
				<tr>
				<th scope="col">Álbum</th>
				<th scope="col">Nombre</th>
				<th scope="col">Reproductor</th>
				<th scope="col">Acciones</th>
				</tr>
				</thead>
			<tbody>
			@foreach($songs as $song)

					@php
					$albumname = "";
					@endphp

					@foreach($albums as $album)
					@php
					if($album->id == $song->album_id){

						$albumname = $album->name;
						

					}

					@endphp

					@endforeach

				<tr>
					<th scope="row">
						<a class="btn btn-sm btn-primary" href="{{ route('albums.show', $song->album_id) }}">{{ $albumname }}</a>       
					</th>
					<td>{{ $song->name }}</td>
					<td> 


						 <script type="text/javascript">

						 	var songfile{{ $song->id }} = decodeEntities( "{{ $song->music_file }}" );

						    $(document).ready(function(){
						      $("#jquery_jplayer_{{ $song->id }}").jPlayer({
						        ready: function () {
						          $(this).jPlayer("setMedia", {
						            title: "{{ $song->name }}",
						            m4a: "{{ asset('storage/music_files/') }}/" + songfile{{ $song->id }},
						            
						          });
						        },
						        cssSelectorAncestor: "#jp_container_{{ $song->id }}",
						        swfPath: "/js",
						        supplied: "m4a",
						        useStateClassSkin: true,
						        autoBlur: false,
						        smoothPlayBar: true,
						        keyEnabled: true,
						        remainingDuration: true,
						        toggleDuration: true
						      });
						    });
						  </script>

					<div id="jquery_jplayer_{{ $song->id }}" class="jp-jplayer"></div>
					<div id="jp_container_{{ $song->id }}" class="jp-audio" role="application" aria-label="media player" style="width: 100%">
						<div class="jp-type-single">
							<div class="jp-gui jp-interface">
								<div class="jp-controls">
									<button class="jp-play" role="button" tabindex="0">play</button>
									<button class="jp-stop" role="button" tabindex="0">stop</button>
								</div>
								<div class="jp-progress">
									<div class="jp-seek-bar">
										<div class="jp-play-bar"></div>
									</div>
								</div>
								<div class="jp-volume-controls">
									<button class="jp-mute" role="button" tabindex="0">mute</button>
									<button class="jp-volume-max" role="button" tabindex="0">max volume</button>
									<div class="jp-volume-bar">
										<div class="jp-volume-bar-value"></div>
									</div>
								</div>
								<div class="jp-time-holder">
									<div class="jp-current-time" role="timer" aria-label="time">&nbsp;</div>
									<div class="jp-duration" role="timer" aria-label="duration">&nbsp;</div>
									<div class="jp-toggles">
										<button class="jp-repeat" role="button" tabindex="0">repeat</button>
									</div>
								</div>
							</div>
							<div class="jp-details">
								<div class="jp-title" aria-label="title">&nbsp;</div>
							</div>
							<div class="jp-no-solution">
								<span>Update Required</span>
								To play the media you will need to either update your browser to a recent version or update your <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
							</div>
						</div>
					</div>





					</td>
					
					<td>
						
						<!-- Button trigger modal -->
					<a class="btn btn-sm btn-info" href="{{ route('songs.edit', $song->id) }}">Editar</a>

					<button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#songDelete_{{ $song->id }}">Borrar</button>
					
					</td>
				</tr>
				
				<tr style="height: 20px !important;"></tr>

				<div class="modal fade" id="songDelete_{{ $song->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog">
									<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title green-title-sm">Estatus</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
					  
								<form method="POST" action="{{ route('songs.destroy', $song->id) }}">

									<div class="row">
			      						<div class="modal-r-body col-8" style="margin: auto;">

											{{ csrf_field() }}	
											{{ method_field('DELETE') }}

											<input type="hidden" name="origin" value=0>

											<h4>¿Quieres borrar la canción "<strong>{{ $song->name }}</strong>" de la aplicación de forma definitiva?
											</h4>
											<h5 style="color: red;"> Esta acción no se puede deshacer</h5>

										</div>

										<div class="modal-footer col-8" style="margin: auto;">
												<button type="submit" class="btn btn-danger">Sí</button>
												<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
										</div>
									</div>
								
								</form>
					  
					</div>
				  </div>
				</div>
			@endforeach
				
			</tbody>
			</table>
					
				</div>
				
			</div>
			
			
		</div>
	</div>
</div>

	
	
	
@endsection
